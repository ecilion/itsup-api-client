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

namespace Itsup\Api\Model\AdZone;

use Itsup\Api\Annotation\Transform;
use Itsup\Api\Model\AbstractModel;
use Itsup\Api\Model\AdZone;
use Itsup\Api\Model\Campaign;

/**
 * @author Cyril LEGRAND <cyril@sctr.net>
 *
 * @method AdZone getAdZone()
 * @method Campaign getCampaign()
 * @method int getWeight()
 * @method string getStatus()
 * @method int getImpressionsLimit()
 * @method setAdZone(AdZone $adZone)
 * @method setCampaign(Campaign $campaign)
 * @method setWeight(int $weight)
 * @method setStatus(string $status)
 * @method setImpressionsLimit(int $impressionsLimit)
 */
class AdZoneCampaign extends AbstractModel
{
    /**
     * @var AdZone
     * @Transform("class", class="Itsup\Api\Model\AdZone")
     */
    public $adZone;

    /**
     * @var Campaign
     * @Transform("class", class="Itsup\Api\Model\Campaign")
     */
    public $campaign;

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
     * @var int
     * @Transform("int")
     */
    public $impressionsLimit;
}
