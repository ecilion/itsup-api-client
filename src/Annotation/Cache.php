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

namespace Itsup\Api\Annotation;

use Doctrine\Common\Annotations\Annotation;

/**
 * @author Cyril LEGRAND <cyril@sctr.net>
 *
 * Cache Class
 * @Annotation
 */
class Cache
{
    public $key;

    public $name;

    public $parameters = [];

    public $tags = [];

    public $ttl;

    public function __construct(array $values)
    {
        $this->ttl = 60 * 60 * 6;
        unset($values['key']);
        if (isset($values['value'])) {
            $values['name'] = $values['value'];
            unset($values['value']);
        }

        foreach ($values as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }
}
