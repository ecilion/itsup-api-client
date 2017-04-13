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
use Itsup\Api\Model\Group;

/**
 * @author Cyril LEGRAND <cyril@sctr.net>
 */
class GroupEndPoint extends AbstractEntityEndPoint
{
    /**
     * The model name.
     *
     * @var string
     */
    protected $model = 'Group';

    /**
     * @param Group $group
     *
     * @return array|bool|AbstractModel
     */
    public function findAdZones(Group $group)
    {
        return $this->handleRequest(
            'GET',
            $this->getRoute().'/'.$group->getId().'/zones',
            [],
            'array'
        );
    }
}
