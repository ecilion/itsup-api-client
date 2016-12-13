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

use Doctrine\Common\Collections\ArrayCollection;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Response;
use Itsup\Api\Exception\ApiException;
use Itsup\Api\Model\AbstractModel;
use Itsup\Api\Transformer\AnnotationTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use Psr\Http\Message\ResponseInterface;

/**
 * @author Cyril LEGRAND <cyril@sctr.net>
 */
abstract class AbstractEntityEndPoint extends AbstractEndPoint
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
     * Model properties that should be send as extra to the API.
     *
     * @var string[]
     */
    protected $propertiesToSendAsExtra = [];

    /**
     * Model properties that should not be send to the API.
     *
     * @var string[]
     */
    protected $propertiesNotToBeSend = [];

    /**
     * Model Properties that are objects but only their ids should be send to the API.
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
     * Returns an object from the given parameters.
     *
     * @param AbstractModel $object
     *
     * @throws ApiException
     *
     * @return bool|AbstractModel|array
     */
    public function find(AbstractModel $object)
    {
        return $this->handleRequest(
            'GET',
            $this->getRoute(),
            $this->formatObjectToPost($object, false)
        );
    }

    /**
     * Returns an object from the given parameters.
     *
     * @param AbstractModel $object
     *
     * @throws ApiException
     *
     * @return bool|AbstractModel|array
     */
    public function findAll(AbstractModel $object)
    {
        return $this->handleRequest(
            'GET',
            $this->getRoute().'/all',
            $this->formatObjectToPost($object, false),
            'model',
            true
        );
    }

    /**
     * Create an object using the API.
     *
     * @param AbstractModel $object
     *
     * @return bool|AbstractModel|array
     */
    public function create(AbstractModel $object)
    {
        return $this->handleRequest(
            'POST',
            $this->getRoute(),
            $this->formatObjectToPost($object)
        );
    }

    /**
     * Update an object using the API.
     *
     * @param AbstractModel $object
     *
     * @return bool|AbstractModel
     */
    public function update(AbstractModel $object)
    {
        return $this->handleRequest(
            'POST',
            $this->getRoute().'/update',
            $this->formatObjectToPost($object)
        );
    }

    /**
     * Delete an object using the API.
     *
     * @param AbstractModel $object
     *
     * @return bool|AbstractModel
     */
    public function delete(AbstractModel $object)
    {
        return $this->handleRequest(
            'DELETE',
            $this->getRoute().'/'.$object->getId()
        );
    }

    /**
     * Try to get the result from the cache, if not make the API call, then return the formatted result.
     *
     * @param string $method
     * @param string $route
     * @param array  $parameters
     * @param string $returnType
     * @param bool   $collection
     *
     * @throws ApiException
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
        } catch (\Exception $exception) {
            throw new ApiException(
                [
                    'code'    => $exception->getCode(),
                    'type'    => get_class($exception),
                    'message' => $exception->getMessage(),
                ]
            );
        }
        if ($response->getStatusCode() >= 400) {
            $result              = json_decode($response->getBody()->getContents(), true);
            $exceptionParameters =
                isset($result['ApiException']) ?
                    $result['ApiException'] :
                    ['code' => 500, 'type' => 'internal_exception', 'message' => 'Internal Server Error'];
            throw new ApiException($exceptionParameters);
        }
        if ($returnType === 'model') {
            return $this->buildObject($this->getModel(), $response, $collection);
        } else {
            if ($returnType !== 'array') {
                $class = '\Itsup\Api\Model\\'.$returnType;
                if (class_exists($class)) {
                    return $this->buildObject($returnType, $response, $collection);
                }
            }
            $result = json_decode($response->getBody()->getContents(), true);

            return isset($result['content']) ? $result['content'] : [];
        }
    }

    /**
     * Transform an API response into a given Model or collection of Model.
     *
     * @param string            $model
     * @param ResponseInterface $response
     * @param bool              $collection
     *
     * @throws ApiException
     *
     * @return mixed
     */
    public function buildObject(string $model, ResponseInterface $response, bool $collection = false)
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
                    $items->add($this->createObject($class, $item, $transformer));
                }

                return $items;
            }

            if (empty($data)) {
                $message = sprintf(
                    "Response from API returned malformed data.\n\nData: %s",
                    (string) $response->getBody()
                );
                if (is_array($json)) {
                    $message = sprintf(
                        "Response from API returned malformed data.\n\nURL: %s\n\nData: %s\n\nFull Json: %s",
                        $json['_links']['self'],
                        $json['content'],
                        json_encode($json)
                    );
                }

                throw new ApiException(
                    [
                        'code'    => 500,
                        'type'    => 'invalid_json',
                        'message' => $message,
                    ]
                );
            }

            return $this->createObject($class, $data, $transformer);
        }

        return ['data' => $data, 'links' => $json['_links'], 'authentication' => $json['authentication']];
    }

    /**
     * Create a new object with the data received from the API.
     *
     * @param string                $class
     * @param array                 $data
     * @param AnnotationTransformer $transformer
     *
     * @return AbstractModel
     */
    private function createObject(string $class, array $data, AnnotationTransformer $transformer): AbstractModel
    {
        return new $class($this->manager->createData(new Item($data, $transformer))->toArray()['data']);
    }

    /**
     * Format object to a format usable by the API POST call.
     *
     * @param AbstractModel $object
     * @param bool|string   $formName
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
