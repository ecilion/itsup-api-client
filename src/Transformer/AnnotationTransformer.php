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

namespace Itsup\Api\Transformer;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\CachedReader;
use Doctrine\Common\Cache\FilesystemCache;
use League\Fractal\Manager;
use League\Fractal\TransformerAbstract;
use ReflectionClass;
use Sctr\Bang\Api\Annotation\Hide;
use Sctr\Bang\Api\Annotation\Transform;

/**
 * @author Cyril LEGRAND <cyril@sctr.net>
 */
class AnnotationTransformer extends TransformerAbstract
{
    /**
     * @var Manager
     */
    private $manager;

    /**
     * @var string
     */
    private $cacheDir;

    /**
     * @var string
     */
    private $model;

    /**
     * AnnotationTransformer constructor.
     *
     * @param Manager $manager
     * @param string  $cacheDir
     * @param string  $model
     */
    public function __construct(Manager $manager, string $cacheDir, string $model)
    {
        $this->manager  = $manager;
        $this->cacheDir = $cacheDir;
        $this->model    = $model;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function transform(array $data): array
    {
        $reader = new CachedReader(
            new AnnotationReader(),
            new FilesystemCache($this->cacheDir),
            $debug = true
        );

        $reflectionClass = new ReflectionClass($this->model);
        $annotation      = $reader->getClassAnnotation($reflectionClass, Hide::class);
        if (!empty($annotation)) {
            foreach ($annotation->properties as $property) {
                if (isset($data[$property])) {
                    unset($data[$property]);
                }
            }
        }

        foreach ($reflectionClass->getProperties() as $property) {
            $annotation = $reader->getPropertyAnnotation($property, Transform::class);
            if (!empty($annotation)) {
                $name = $this->toSnakeCase($property->getName());

                if (isset($data[$name])) {
                    $data[$name] = $this->castValue($annotation, $data[$name]);
                } else {
                    $name = $property->getName();
                    $name = lcfirst($name);
                    if (isset($data[$name])) {
                        $data[$name] = $this->castValue($annotation, $data[$name]);
                    }
                }
            }
        }

        return $data;
    }

    /**
     * @param $annotation
     * @param $value
     *
     * @throws \Exception
     *
     * @return array|bool|\DateTime|string|null
     */
    private function castValue($annotation, $value)
    {
        if ($value === null) {
            return;
        }

        switch ($annotation->type) {
            case 'string':
                if ($annotation->collection) {
                    return array_map('strval', $value);
                }

                return (string) $value;
            case 'int':
            case 'integer':
                if ($annotation->collection) {
                    return array_map('intval', $value);
                }

                return (int) $value;
            case 'float':
                if ($annotation->collection) {
                    return array_map('floatval', $value);
                }

                return (float) $value;
            case 'double':
                if ($annotation->collection) {
                    return array_map('doubleval', $value);
                }

                return (float) $value;
            case 'bool':
            case 'boolean':
                if ($annotation->collection) {
                    return array_map('boolval', $value);
                }

                if (in_array(strtolower($value), ['yes', 'no'])) {
                    return $value === 'yes';
                }

                return (bool) $value;
            case 'date':
            case 'datetime':
                $value = (is_numeric($value)) ? date('Y-m-d H:i:s', $value) : $value;

                return new \DateTime($value, $annotation->timezone);
            case 'class':
                $class = $annotation->class;
                if ($annotation->collection) {
                    return $this->transformCollection($value, $class);
                }

                return $this->transformItem($value, $class);
        }

        throw new \Exception('Invalid Transformation type: '.$annotation->type);
    }

    /**
     * @param array  $data
     * @param string $model
     *
     * @return array
     */
    private function transformItem(array $data, string $model): array
    {
        $transformer = new self($this->manager, $this->cacheDir, $model);

        return new $model($this->manager->createData($this->item($data, $transformer))->toArray()['data']);
    }

    /**
     * @param array  $data
     * @param string $model
     *
     * @return array
     */
    private function transformCollection(array $data, string $model): array
    {
        return array_map(
            function ($item) use ($model) {
                return $this->transformItem($item, $model);
            },
            $data
        );
    }

    /**
     * @param string $string
     *
     * @return string
     */
    private function toSnakeCase(string $string): string
    {
        return strtolower(preg_replace(['/([a-z\d])([A-Z])/', '/([^_])([A-Z][a-z])/'], '$1_$2', $string));
    }
}
