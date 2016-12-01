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

/**
 * @author Cyril LEGRAND <cyril@sctr.net>
 * @Annotation
 * @Target({"PROPERTY"})
 */
class Transform
{
    /**
     * @var string
     */
    public $type;

    public $class;

    public $collection = false;

    public $timezone;

    /**
     * Transform constructor.
     *
     * @param array $values
     */
    public function __construct(array $values = [])
    {
        if (isset($values['value'])) {
            $this->type = $values['value'];
            unset($values['value']);
        }

        foreach ($values as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}
