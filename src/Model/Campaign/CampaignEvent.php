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

namespace Itsup\Api\Model\Campaign;

use Itsup\Api\Annotation\Transform;
use Itsup\Api\Model\AbstractModel;
use Itsup\Api\Model\Campaign;
use Itsup\Api\Model\Event;

/**
 * @author Alex VASIC <alex@quantox.com>
 *
 * @method Campaign getCampaign()
 * @method Event getEvent()
 * @method string getDefault()
 * @method setCampaign(Campaign $campaign)
 * @method setEvent(Event $event)
 * @method setDefault(string $default)
 */
class CampaignEvent extends AbstractModel
{
    /**
     * @var Campaign
     * @Transform("class", class="Itsup\Api\Model\Campaign")
     */
    public $campaign;

    /**
     * @var Event
     * @Transform("class", class="Itsup\Api\Model\Event")
     */
    public $event;

    /**
     * @var string
     */
    public $default;
}
