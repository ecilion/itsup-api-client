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

use Itsup\Api\Exception\ApiException;
use Itsup\Api\Model\AbstractModel;

/**
 * @author Cyril LEGRAND <cyril@sctr.net>
 */
class StatisticsEndPoint extends AbstractEntityEndPoint
{
    /**
     * The model name.
     *
     * @var string
     */
    protected $model = 'Statistics';

    /**
     * Returns an object from the given parameters.
     *
     * @param array $parameters
     *
     * @throws \Exception
     *
     * @return array
     */
    public function get(array $parameters = [])
    {
        return $this->handleRequest('GET', $this->getRoute(), $parameters, 'array');
    }

    /**
     * Returns an object from the given parameters.
     *
     * @param AbstractModel $object
     *
     * @throws ApiException
     *
     * @return array
     */
    public function find(AbstractModel $object)
    {
        return $this->handleRequest(
            'GET',
            $this->getRoute(),
            $this->formatObjectToPost($object, false),
            'array'
        );
    }
}
