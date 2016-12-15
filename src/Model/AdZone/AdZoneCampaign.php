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

/**
 * @author Cyril LEGRAND <cyril@sctr.net>
 *
 * @method int getId()
 * @method AdZone getAdZone()
 * @method \DateTime getFrom()
 * @method \DateTime getTo()
 * @method string getType()
 * @method float getCost()
 */
class AdZoneCampaign extends AbstractModel
{
    /**
     * @var int
     * @Transform("int")
     */
    public $id;

    /**
     * @var AdZone
     * @Transform("class", class="Itsup\Api\Model\AdZone")
     */
    public $adZone;

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
     * @var string
     */
    public $type;

    /**
     * @var float
     * @Transform("float")
     */
    public $cost;
}
