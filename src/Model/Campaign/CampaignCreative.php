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
use Itsup\Api\Model\Creative;

/**
 * @author Cyril LEGRAND <cyril@sctr.net>
 *
 * @method Campaign getCampaign()
 * @method Creative getCreative()
 * @method int getWeight()
 * @method string getStatus()
 * @method string getUrl()
 *
 * @method setCampaign(Campaign $campaign)
 * @method setCreative(Creative $creative)
 * @method setWeight(int $weight)
 * @method setStatus(string $status)
 * @method setUrl(string $url)
 */
class CampaignCreative extends AbstractModel
{
    /**
     * @var Campaign
     * @Transform("class", class="Itsup\Api\Model\Campaign")
     */
    public $campaign;

    /**
     * @var Creative
     * @Transform("class", class="Itsup\Api\Model\Creative")
     */
    public $creative;

    /**
     * @var int
     * @Transform("int")
     */
    public $weight;

    /**
     * @var string
     */
    public $status;

    /**
     * @var string
     */
    public $url;
}
