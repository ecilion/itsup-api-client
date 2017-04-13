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

use Itsup\Api\Model\AbstractModel;

/**
 * @author Cyril LEGRAND <cyril@sctr.net>
 */
class CreativeEndPoint extends AbstractNoteEndPoint
{
    /**
     * The model name.
     *
     * @var string
     */
    protected $model = 'Creative';

    /**
     * Creative properties that should not be send to the api.
     *
     * @var string[]
     */
    protected $propertiesNotToBeSent = [
        'dateCreated',
    ];

    /**
     * @return array|bool|AbstractModel
     */
    public function findSizes()
    {
        return $this->handleRequest(
            'GET',
            $this->getRoute().'/sizes',
            [],
            'array'
        );
    }
}
