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

namespace Itsup\Api;

use Cache\Adapter\Common\AbstractCachePool;
use Cache\Taggable\TaggablePoolInterface;
use Doctrine\Common\Annotations\AnnotationRegistry;
use GuzzleHttp\Client as BaseClient;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Cyril LEGRAND <cyril@sctr.net>
 *
 * @property-read \Sctr\Bang\Api\Endpoint\AdminEndpoint     $admin
 * @property-read \Sctr\Bang\Api\Endpoint\AffiliateEndpoint $affiliate
 * @property-read \Sctr\Bang\Api\Endpoint\CustomerEndpoint  $customer
 * @property-read \Sctr\Bang\Api\Endpoint\EmailEndpoint     $email
 * @property-read \Sctr\Bang\Api\Endpoint\GeoIpEndpoint     $geoip
 * @property-read \Sctr\Bang\Api\Endpoint\PromotionEndpoint $promotion
 * @property-read \Sctr\Bang\Api\Endpoint\SessionEndpoint   $session
 */
class Client extends BaseClient
{
    /**
     * @var string
     */
    protected $cacheDir;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var AbstractCachePool|CacheItemPoolInterface|TaggablePoolInterface|null
     */
    protected $cache;

    /**
     * @var string
     */
    protected $directory;

    /**
     * Client constructor.
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $config             = $this->resolveConfig($config);
        $config['base_uri'] = $config['scheme'].'://'.$config['host'];
        $this->type         = $config['type'];
        $this->apiKey       = $config['api_key'];
        $this->cache        = isset($config['cache']) && !is_string($config['cache']) ? $config['cache'] : null;

        AnnotationRegistry::registerFile(__DIR__.'/Annotation/Cache.php');
        AnnotationRegistry::registerFile(__DIR__.'/Annotation/Hide.php');
        AnnotationRegistry::registerFile(__DIR__.'/Annotation/Transform.php');
        $this->cacheDir = $config['cache_dir'];
        unset($config['cache_dir']);
        unset($config['version']);

        parent::__construct($config);
    }

    /**
     * @return null|string
     */
    public function getCacheDir(): ?string
    {
        return $this->cacheDir;
    }

    /**
     * @return null|string
     */
    public function getType(): ?string
    {
        if (!isset($this->type) || empty($this->type)) {
            return $this->getConfig('type');
        }

        return $this->type;
    }

    /**
     * @return null|string
     */
    public function getApiKey(): ?string
    {
        if (!isset($this->apiKey) || empty($this->apiKey)) {
            return $this->getConfig('api_key');
        }

        return $this->apiKey;
    }

    /**
     * @param string $type
     * @param string $apiKey
     */
    public function setTypeAndApiKey(string $type, string $apiKey): void
    {
        $this->type   = $type;
        $this->apiKey = $apiKey;
    }

    /**
     * @return AbstractCachePool|CacheItemPoolInterface|TaggablePoolInterface|null
     */
    public function getCache()
    {
        return $this->cache;
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function clearCacheKey(string $key): bool
    {
        return $this->cache->deleteItem($key);
    }

    /**
     * @param string[] $keys
     *
     * @return bool
     */
    public function clearCacheKeys(array $keys): bool
    {
        return $this->cache->deleteItems($keys);
    }

    /**
     * @param string $tag
     *
     * @return bool
     */
    public function clearCacheTag(string $tag): bool
    {
        return $this->cache->clear([$tag]);
    }

    /**
     * @param string $name
     * @param array  $arguments
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function __call(string $name, array $arguments = [])
    {
        $modelClass = '';
        $function   = '';
        switch ($name) {
            case 'create':
            case 'update':
            case 'delete':
            case 'setTags':
            case 'addNote':
            case 'updateNote':
            case 'deleteNote':
                $modelClass = get_class($arguments[0]);
                $endPoint   = '\\'.str_replace('Model', 'EndPoint', $modelClass).'EndPoint';
                $function   = $name;
                break;
            default:
                if (strpos($name, 'findAll') !== false) {
                    $modelClass = str_replace('findAll', '', $name);
                    $function   = 'findAll';
                } elseif (strpos($name, 'find') !== false) {
                    $modelClass = str_replace('find', '', $name);
                    $function   = 'find';
                }
                $endPoint = '\Itsup\Api\Endpoint\\'.$modelClass.'Endpoint';
        }
        if (!class_exists($endPoint)) {
            throw new \Exception("Endpoint \"{$modelClass}\" does not exist. ");
        }

        return $this->call($endPoint, $function, $arguments);
    }

    /**
     * @param string $endPointClass
     * @param string $function
     * @param array  $arguments
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function call(string $endPointClass, string $function, array $arguments = [])
    {
        $endPoint = new $endPointClass($this);
        if (!method_exists($endPoint, $function)) {
            throw new \Exception('Function "'.$function.'" does not exists for endPoint "'.$endPointClass.'"');
        }

        $nbArguments = count($arguments);
        if ($nbArguments === 2) {
            return $endPoint->$function($arguments[0], $arguments[1]);
        } else {
            return $endPoint->$function($arguments[0]);
        }
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array  $options
     *
     * @return mixed
     */
    public function requestAsync(string $method, string $uri = '', array $options = [])
    {
        $options['headers'] = isset($options['headers']) ? $options['headers'] : [];
        if (!isset($options['headers']['Authorization'])) {
            $options['headers']['Authorization'] = $this->getType().' '.$this->getApiKey();
        }

        return parent::requestAsync($method, $uri, $options);
    }

    /**
     * @param array $config
     *
     * @return array
     */
    private function resolveConfig(array $config): array
    {
        $resolver = new OptionsResolver();

        $resolver->setDefined('cache');
        $resolver->setDefaults(['host' => 'api.itsup.com', 'version' => 1, 'scheme' => 'https', 'type' => 'internal']);
        $resolver->setRequired(['host', 'version', 'api_key', 'cache_dir']);

        $resolver->setAllowedTypes('cache', TaggablePoolInterface::class);
        $resolver->setAllowedTypes('host', 'string');
        $resolver->setAllowedTypes('version', ['string', 'int']);
        $resolver->setAllowedTypes('api_key', 'string');

        $resolver->setAllowedValues(
            'host',
            ['api.itsup.com', 'dev.api.itsup.com', 'development.api.itsup.com', 'staging.api.itsup.com']
        );
        $resolver->setAllowedValues('type', ['internal', 'user']);
        $resolver->setAllowedValues('version', [1]);

        return $resolver->resolve($config);
    }
}
