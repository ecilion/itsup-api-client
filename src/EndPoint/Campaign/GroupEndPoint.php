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

namespace Itsup\Api\EndPoint\Campaign;

use Itsup\Api\EndPoint\AbstractEntityEndPoint;
use Itsup\Api\Model\AbstractModel;
use Itsup\Api\Model\Campaign\Group;

/**
 * @author Alex VASIC <alex@quantox.com>
 */
class GroupEndPoint extends AbstractEntityEndPoint
{
    /**
     * The model name.
     *
     * @var string
     */
    protected $model = 'Campaign\Group';

    /**
     * The API URI without the first "/".
     *
     * @var string
     */
    protected $route = 'campaign/group';

    /**
     * @param Group $group
     *
     * @return array|bool|AbstractModel
     */
    public function findCampaigns(Group $group)
    {
        return $this->handleRequest(
            'GET',
            $this->getRoute().'/'.$group->getId().'/campaigns',
            [],
            'array'
        );
    }
}
