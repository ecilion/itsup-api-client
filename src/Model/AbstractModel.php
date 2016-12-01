<?php

/*
 * Copyright 2016 SCTR Services
 *
 * Distribution and reproduction are prohibited.
 *
 * @package     bang-api-client
 * @copyright   SCTR Services LLC 2016
 * @license     No License (Proprietary)
 */

namespace Itsup\Api\Model;

/**
 * @author Cyril LEGRAND <cyril@sctr.net>
 */
abstract class AbstractModel
{
    /**
     * @var array
     */
    protected $extraData = [];

    /**
     * AbstractModel constructor.
     *
     * @param array $content
     */
    public function __construct(array $content)
    {
        foreach ($content as $key => $value) {
            $key = lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $key))));
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            } else {
                $this->extraData[$key] = $value;
            }
        }
    }

    /**
     * Catch for extraData.
     *
     * @param string     $name
     * @param array|null $arguments
     *
     * @return mixed
     */
    public function __call($name, $arguments = null)
    {
        if (strpos($name, 'get') === 0) {
            $key = lcfirst(str_replace('get', '', $name));
            if ($key === '' && isset($arguments[0])) {
                $key = $arguments[0];
            }
            if (array_key_exists($key, $this->extraData)) {
                return $this->extraData[$key];
            }

            if (property_exists($this, $key)) {
                return $this->$key;
            }
        }

        if (strpos($name, 'set') === 0) {
            $key = lcfirst(str_replace('set', '', $name));
            if (property_exists($this, $key)) {
                return $this->$key = $arguments[0];
            }

            return $this->extraData[$key] = $arguments[0];
        }

        throw new \BadMethodCallException('Method does not exist: '.$name);
    }

    /**
     * Getter for symfony forms.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function __get($key)
    {
        if (property_exists($this, $key)) {
            return $this->$key;
        }

        return $this->extraData[$key];
    }

    /**
     * Setter for Symfony Forms.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return mixed
     */
    public function __set($key, $value)
    {
        if (property_exists($this, $key)) {
            return $this->$key = $value;
        }

        return $this->extraData[$key] = $value;
    }

    /**
     * Gets an item from extraData by the given key.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function getExtra($key)
    {
        return array_key_exists($key, $this->extraData) ? $this->extraData[$key] : null;
    }

    final public function getClassVars()
    {
        return array_keys(get_class_vars(get_class($this)));
    }
}
