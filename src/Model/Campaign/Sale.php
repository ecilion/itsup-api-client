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
use Itsup\Api\Model\Campaign;

/**
 * @author Cyril LEGRAND <cyril@sctr.net>
 *
 * @method int getId()
 * @method Campaign getCampaign()
 * @method array|Limit[] getLimit()
 * @method string getType()
 * @method \DateTime getFrom()
 * @method \DateTime getTo()
 * @method bool isExpire()
 * @method float getPrice()
 */
class Sale extends AbstractModel
{
    /**
     * @var int
     * @Transform("int")
     */
    public $id;

    /**
     * @var Campaign
     * @Transform("class", class="Itsup\Api\Model\Campaign")
     */
    public $campaign;

    /**
     * @var Limit[]
     * @Transform("class", class="Itsup\Api\Model\Campaign/Limit", collection=true)
     */
    public $limit;

    /**
     * @var string
     */
    public $type;

    /**
     * @var \DateTime
     * @Transform("date")
     */
    public $from;

    /**
     * @var \DateTime
     * @Transform("date")
     */
    public $to;

    /**
     * @var bool
     * @Transform("bool")
     */
    public $expire;

    /**
     * @var float
     * @Transform("float")
     */
    public $price;
}
