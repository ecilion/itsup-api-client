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

namespace Itsup\Api\Endpoint;

use Cache\Taggable\TaggablePoolInterface;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Collections\ArrayCollection;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Response;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use Psr\Http\Message\ResponseInterface;
use Itsup\Api\Annotation\Cache;
use Itsup\Api\Client;
use Itsup\Api\Model\AbstractModel;
use Itsup\Api\Transformer\AnnotationTransformer;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

/**
 * @author Cyril LEGRAND <cyril@sctr.net>
 */
abstract class AbstractEndpoint
{
    /**
     * The model name.
     *
     * @var string
     */
    protected $model;

    /**
     * The API URI without the first "/".
     *
     * @var string
     */
    protected $route;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var Manager
     */
    protected $manager;

    /**
     * Model properties that need to be send as extra.
     *
     * @var string[]
     */
    protected $propertiesToSendAsExtra = [];

    /**
     * Model properties that don't need to be send.
     *
     * @var string[]
     */
    protected $propertiesNotToBeSend = [];

    /**
     * Model Properties that are objects but only the id needs to be send to the api form.
     *
     * @var array
     */
    protected static $propertiesToConvertToId = [
        'account',
        'user',
        'adZone',
        'campaign',
        'creative',
        'offer',
        'event',
        'createdBy',
        'updatedBy',
    ];

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
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * @return string
     */
    protected function getRoute(): string
    {
        return '/'.$this->route;
    }

    /**
     * @return array
     */
    protected function setCacheSettings(): array
    {
        return [];
    }

    /**
     * Returns an object from the given parameters.
     *
     * @param array $parameters
     *
     * @throws \Exception
     *
     * @return bool|AbstractModel|array
     */
    public function find(array $parameters = [])
    {
        return $this->handleRequest('GET', $this->getRoute(), $parameters);
    }

    /**
     * Returns an object from the given parameters.
     *
     * @param array $parameters
     *
     * @throws \Exception
     *
     * @return bool|AbstractModel|array
     */
    public function findAll(array $parameters = [])
    {
        return $this->handleRequest('GET', $this->getRoute().'/all', $parameters, 'model', true);
    }

    /**
     * Create an object using the API.
     *
     * @param $object
     *
     * @return bool|AbstractModel|array
     */
    public function create($object)
    {
        return $this->handleRequest('POST', $this->getRoute(), $this->formatObjectToPost($object));
    }

    /**
     * Update an object using the API.
     *
     * @param $object
     *
     * @return bool|AbstractModel
     */
    public function update($object)
    {
        return $this->handleRequest('POST', $this->getRoute().'/update', $this->formatObjectToPost($object));
    }

    /**
     * Delete an object using the API.
     *
     * @param $object
     *
     * @return bool|AbstractModel
     */
    public function delete($object)
    {
        return $this->handleRequest('DELETE', $this->getRoute().'/'.$object->getId());
    }

    /**
     * @param string $method
     * @param string $route
     * @param array  $parameters
     * @param string $returnType
     * @param bool   $collection
     *
     * @throws \Exception
     *
     * @return bool|AbstractModel|array
     */
    public function handleRequest(
        string $method,
        string $route,
        array $parameters = [],
        string $returnType = 'model',
        bool $collection = false
    ) {
        try {
            $response = $this->cacheRequest($method, $route, $parameters);

            if ($returnType === 'model') {
                return $this->buildModel($this->getModel(), $response, $collection);
            } else {
                if ($returnType !== 'array') {
                    $class = '\Itsup\Api\Model\\'.$returnType;
                    if (class_exists($class)) {
                        return $this->buildModel($returnType, $response, $collection);
                    }
                }
                $result = json_decode($response->getBody()->getContents(), true);

                return isset($result['content']) ? $result['content'] : [];
            }
        } catch (\Exception $exception) {
            if ($exception instanceof ServerException || $exception instanceof ClientException) {
                if ($exception->getCode() === 404) {
                    return false;
                }
            }

            throw $exception;
        }
    }

    /**
     * @param string            $model
     * @param ResponseInterface $response
     * @param bool              $collection
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function buildModel(string $model, ResponseInterface $response, bool $collection = false)
    {
        $class = '\Itsup\Api\Model\\'.$model;

        $json = json_decode((string) $response->getBody(), true);
        $data = $json['content'];

        if (!isset($json['_links'])) {
            $json['_links'] = [];
        }

        foreach ($json['_links'] as $key => $value) {
            if (!in_array($key, ['self', 'docs'])) {
                $data[$key] = $value;
            }
        }

        if (class_exists($class)) {
            $transformer = new AnnotationTransformer($this->manager, $this->client->getCacheDir(), $class);

            if ($collection) {
                $items = new ArrayCollection();
                foreach ($data as $item) {
                    $items->add($this->createClass($class, $item, $transformer));
                }

                return $items;
            }

            if (empty($data)) {
                if (is_array($json)) {
                    throw new \Exception(
                        sprintf(
                            "Response from API returned malformed data.\n\nURL: %s\n\nData: %s\n\nFull Json: %s",
                            $json['_links']['self'],
                            $json['content'],
                            json_encode($json)
                        )
                    );
                }

                throw new \Exception(
                    sprintf(
                        "Response from API returned malformed data.\n\nData: %s",
                        (string) $response->getBody()
                    )
                );
            }

            return $this->createClass($class, $data, $transformer);
        }

        return ['data' => $data, 'links' => $json['_links'], 'authentication' => $json['authentication']];
    }

    /**
     * @param string                $class
     * @param array                 $data
     * @param AnnotationTransformer $transformer
     *
     * @return AbstractModel
     */
    private function createClass(string $class, array $data, AnnotationTransformer $transformer): AbstractModel
    {
        return new $class($this->manager->createData(new Item($data, $transformer))->toArray()['data']);
    }

    /**
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
     * @param TaggablePoolInterface $cache
     * @param array|Cache[]         $cacheAnnotations
     *
     * @return Response|null
     */
    private function fetchFromCache(TaggablePoolInterface $cache, array $cacheAnnotations): ?Response
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

    /**
     * Format object to a format usable by the API POST call.
     *
     * @param AbstractModel $object
     * @param bool|string $formName
     *
     * @return array
     */
    public function formatObjectToPost(AbstractModel $object, bool $formName = false): array
    {
        $return = [];
        $array  = [];
        $keys   = $object->getClassVars();
        foreach ($keys as $key) {
            $value = $object->get($key);
            if (
                !in_array($key, $this->propertiesNotToBeSend) &&
                (
                    $value === false ||
                    !empty($value)
                ) &&
                !is_null($value) &&
                $key !== 'extraData'
            ) {
                if (in_array($key, $this->propertiesToSendAsExtra)) {
                    $object->addExtra($key, $value);

                    continue;
                }
                $array[$key] =
                    is_object($value) ?
                        (
                            in_array($key, self::$propertiesToConvertToId) && !empty($value->getId()) ?
                                $value->getId() :
                                $this->formatObjectToPost($value)
                        ) :
                        $value;
            }
        }

        if ($formName === false) {
            return $array;
        }

        $formKey          = array_pop(explode('\\', get_class($object)));
        $return[$formKey] = $array;
        $extra            = $object->getExtraData();
        if (count($extra) > 0) {
            $return = array_merge($return, $extra);
        }

        return $return;
    }
}
