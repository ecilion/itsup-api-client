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

namespace Itsup\Api\Exception;

class ApiException extends \Exception
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var array
     */
    protected $errors;

    /**
     * ApiException constructor.
     *
     * @param array $content
     */
    public function __construct(array $content)
    {
        foreach ($content as $key => $value) {
            $key = lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $key))));
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }

        parent::__construct($this->type, $this->getCode());
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
