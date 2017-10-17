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
use Itsup\Api\Model\Group;

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
            $this->getRoute().'/'.$adZone->getId().'/duplicate/'.$type,
            ['context' => 'id']
        );
    }

    /**
     * Add a group to an adZone using the API.
     *
     * @param AdZone $adZone
     * @param Group  $group
     *
     * @return bool|AdZone
     */
    public function addGroup(AdZone $adZone, Group $group)
    {
        return $this->handleRequest(
            'POST',
            $this->getRoute().'/'.$adZone->getId().'/group/'.$group->getId()
        );
    }

    /**
     * Remove a group from an adZone using the API.
     *
     * @param AdZone $adZone
     * @param Group  $group
     *
     * @return bool|AdZone
     */
    public function removeGroup(AdZone $adZone, Group $group)
    {
        return $this->handleRequest(
            'DELETE',
            $this->getRoute().'/'.$adZone->getId().'/group/'.$group->getId()
        );
    }

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

    /**
     * @param int $minutes
     *
     * @return array|bool|AbstractModel
     */
    public function latestUpdates(int $minutes = 5)
    {
        return $this->handleRequest(
            'GET',
            $this->getRoute().'/latest/updates/'.$minutes,
            [],
            'array'
        );
    }

    /**
     * @return array
     */
    public function findCost()
    {
        return $this->handleRequest(
            'GET',
            $this->getRoute().'/all',
            ['type' => 'accounting'],
            'array'
        );
    }
}
