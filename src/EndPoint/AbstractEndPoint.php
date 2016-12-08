<?php

/*
 * Copyright 2016 SCTR Services
 *
 * Distribution and reproduction are prohibited.
 *
 * @package     itsup-api-client
 * @copyright   SCTR Services LLC 2016
 * @license     No License (Proprietary)
 */

namespace Itsup\Api\EndPoint;

use Cache\Taggable\TaggablePoolInterface;
use Doctrine\Common\Annotations\AnnotationReader;
use GuzzleHttp\Psr7\Response;
use Itsup\Api\Annotation\Cache;
use Itsup\Api\Client;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

/**
 * @author Cyril LEGRAND <cyril@sctr.net>
 */
abstract class AbstractEndPoint
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var Manager
     */
    protected $manager;

    /**
     * @var array
     */
    protected $cacheSettings;

    /**
     * AbstractEndpoint constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client        = $client;
        $this->manager       = new Manager();
        $this->cacheSettings = $this->setCacheSettings();
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @return array
     */
    protected function setCacheSettings(): array
    {
        return [];
    }

    /**
     * Execute the API request call.
     *
     * @param       $type
     * @param       $path
     * @param array $parameters
     *
     * @return ResponseInterface
     */
    protected function request($type, $path, array $parameters = []): ResponseInterface
    {
        $parameters['headers']['Authorization']  =
            $this->client->getType().' '.$this->client->getApiKey();
        $parameters['headers']['Accept-Charset'] = 'utf-8';

        return $this->client->request($type, $path, $parameters);
    }

    /**
     * Try to find the request response in cache, if not make the API request call then return it.
     *
     * @param string $method
     * @param string $route
     * @param array  $parameters
     *
     * @return Response|null|ResponseInterface
     */
    protected function cacheRequest(string $method, string $route, array $parameters = [])
    {
        $param            = ($method === 'POST') ? 'form_params' : 'query';
        $expr             = new ExpressionLanguage();
        $cache            = $this->client->getCache();
        $cacheAnnotations = $this->getCacheAnnotations();
        if (empty($cacheAnnotations) || $cache === null) {
            return $this->request($method, $route, [$param => $parameters]);
        }

        foreach ($cacheAnnotations as $annKey => $annotation) {
            if (!empty($annotation->parameters)) {
                foreach ($annotation->parameters as $key => $value) {
                    try {
                        $annotation->parameters[$key] = $expr->evaluate(
                            $value,
                            ['method' => $method, 'route' => $route, 'parameters' => $parameters]
                        );
                    } catch (\Exception $e) {
                        unset($cacheAnnotations[$annKey]);
                        break;
                    }

                    if ($annotation->parameters[$key] === null) {
                        unset($cacheAnnotations[$annKey]);
                        break;
                    }
                }

                $annotation->key = sprintf('api-client.%s|%s', $annotation->name, sha1(json_encode($parameters)));
            } else {
                $annotation->key = 'api-client.'.$annotation->name;
            }

            $annotation->ttl = $expr->evaluate($annotation->ttl);
        }

        if ($method !== 'GET') {
            $response = $this->request($method, $route, [$param => $parameters]);
            foreach ($cacheAnnotations as $annotation) {
                $cache->deleteItem($annotation->key);
                $cache->clearTags($annotation->tags);
            }

            return $response;
        }

        // Try to fetch from all cache first
        // If that fails, run the response, and save it to all the cache entries
        try {
            $response = $this->fetchFromCache($cache, $cacheAnnotations);
        } catch (\Exception $e) {
            error_log($e->getMessage().' in file '.__FILE__.' on line '.__LINE__);
            // Leave response empty
        }
        if (empty($response)) {
            $response = $this->request($method, $route, [$param => $parameters]);

            $this->cacheResponse($cache, $cacheAnnotations, $response);
        }

        return $response;
    }

    /**
     * Get the Cache Annotations from the EndPoint.
     *
     * @return array|Cache[]
     */
    private function getCacheAnnotations(): array
    {
        $reader  = new AnnotationReader();
        $callers = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 5);

        $caches = [];
        foreach ($callers as $caller) {
            $refl        = new \ReflectionObject($caller['object']);
            $annotations = $reader->getMethodAnnotations($refl->getMethod($caller['function']));
            foreach ($annotations as $annotation) {
                if ($annotation instanceof Cache) {
                    $caches[] = $annotation;
                }
            }
        }

        return $caches;
    }

    /**
     * Fetch an item from the cache.
     *
     * @param TaggablePoolInterface $cache
     * @param array|Cache[]         $cacheAnnotations
     *
     * @return Response|null
     */
    private function fetchFromCache(TaggablePoolInterface $cache, array $cacheAnnotations)
    {
        foreach ($cacheAnnotations as $annotation) {
            $item = $cache->getItem($annotation->key);
            if ($item->isHit()) {
                list($status, $headers, $body) = $item->get();

                return new Response($status, $headers, $body);
            }
        }
    }

    /**
     * Put the API request call response into cache.
     *
     * @param TaggablePoolInterface $cache
     * @param array|Cache[]         $cacheAnnotations
     * @param Response              $response
     */
    private function cacheResponse(TaggablePoolInterface $cache, array $cacheAnnotations, Response $response)
    {
        foreach ($cacheAnnotations as $annotation) {
            $item = $cache->getItem($annotation->key);
            foreach ($annotation->tags as $tag) {
                $item->addTag($tag);
            }

            $item->set([$response->getStatusCode(), $response->getHeaders(), $response->getBody()->__toString()]);
            $item->expiresAfter($annotation->ttl);

            $cache->saveDeferred($item);
        }

        $cache->commit();
    }
}
