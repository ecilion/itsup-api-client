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

/**
 * @author Cyril LEGRAND <cyril@sctr.net>
 */
class TagEndPoint extends AbstractEntityEndPoint
{
    /**
     * The model name.
     *
     * @var string
     */
    protected $model = 'Tag';

    /**
     * Returns all tags.
     *
     * @param array $params
     *
     * @throws ApiException
     *
     * @return bool|AbstractModel|array
     */
    public function listAll($params = [])
    {
        return $this->handleRequest(
            'GET',
            $this->getRoute().'/all',
            $params,
            'array',
            true
        );
    }
}
