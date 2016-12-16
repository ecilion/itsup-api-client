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

/**
 * @author Cyril LEGRAND <cyril@sctr.net>
 *
 * @method int getId()
 * @method Campaign getCampaign()
 * @method \DateTime getFrom()
 * @method \DateTime getTo()
 * @method int getImpressions()
 * @method int getClicks()
 * @method \DateTime getDateReached()
 * @method string getTypeReached()
 */
class Limit extends AbstractModel
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
     * @var int
     * @Transform("int")
     */
    public $clicks;

    /**
     * @var int
     * @Transform("int")
     */
    public $impressions;

    /**
     * @var \DateTime
     * @Transform("date")
     */
    public $dateReached;

    /**
     * @var string
     */
    public $typeReached;
}
