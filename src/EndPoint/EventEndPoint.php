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
use Itsup\Api\Model\Event;

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
     * @param Event  $event
     * @param string $clickId
     *
     * @return array|bool|AbstractModel
     */
    public function decryptClick($event, $clickId)
    {
        return $this->handleRequest(
            'GET',
            $this->getRoute().'/decrypt/'.$clickId,
            ['context' => 'list'],
            'Event\DecryptedClick'
        );
    }
}
