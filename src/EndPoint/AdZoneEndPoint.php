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
use Itsup\Api\Model\AdZone;

/**
 * @author Cyril LEGRAND <cyril@sctr.net>
 */
class AdZoneEndPoint extends AbstractNoteFollowerEndPoint
{
    /**
     * The model name.
     *
     * @var string
     */
    protected $model = 'AdZone';

    /**
     * Creative properties that should not be send to the api.
     *
     * @var string[]
     */
    protected $propertiesNotToBeSent = [
        'dateCreated',
        'createdBy',
        'dateUpdated',
        'updatedBy',
        'followers',
        'notes',
        'campaigns',
        'accounting',
    ];

    /**
     * @param string $type
     * @param AdZone $adZone
     *
     * @return array|bool|AbstractModel
     */
    public function duplicate($adZone, $type)
    {
        return $this->handleRequest(
            'POST',
            $this->getRoute().'/'.$adZone->getId().'/duplicate/'.$type
        );
    }
}
