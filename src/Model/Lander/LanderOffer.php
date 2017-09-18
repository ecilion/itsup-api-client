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

namespace Itsup\Api\Model\Lander;

use Itsup\Api\Annotation\Transform;
use Itsup\Api\Model\AbstractModel;
use Itsup\Api\Model\Lander;
use Itsup\Api\Model\Offer;

/**
 * @author Alex VASIC <alex@quantox.com>
 *
 * @method Lander getLander()
 * @method Offer getOffer()
 * @method string getStatus()
 * @method string getDefault()
 * @method setLander(Lander $lander)
 * @method setOffer(Offer $offer)
 * @method setStatus(string $status)
 * @method setDefault(string $default)
 */
class LanderOffer extends AbstractModel
{
    /**
     * @var Lander
     * @Transform("class", class="Itsup\Api\Model\Lander")
     */
    public $lander;

    /**
     * @var Offer
     * @Transform("class", class="Itsup\Api\Model\Offer")
     */
    public $offer;

    /**
     * @var string
     */
    public $status;

    /**
     * @var string
     */
    public $default;
}
