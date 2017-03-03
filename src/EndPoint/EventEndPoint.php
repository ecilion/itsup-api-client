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
class EventEndPoint extends AbstractEntityEndPoint
{
    /**
     * The model name.
     *
     * @var string
     */
    protected $model = 'Event';

    /**
     * @param string $clickId
     *
     * @return array|bool|AbstractModel
     */
    public function decryptClick($clickId)
    {
        return $this->handleRequest(
            'GET',
            $this->getRoute().'/decrypt/'.$clickId,
            [],
            'Event\DecryptedClick'
        );
    }
}
