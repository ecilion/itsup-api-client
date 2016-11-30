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
 * @Target({"CLASS"})
 */
class Hide
{
    /**
     * @var array<string>
     */
    public $properties;

    /**
     * Transform constructor.
     *
     * @param array $values
     */
    public function __construct(array $values = [])
    {
        if (isset($values['value'])) {
            $this->properties = $values['value'];
            unset($values['value']);
        } else {
            $this->properties = $values['properties'];
        }
    }
}
