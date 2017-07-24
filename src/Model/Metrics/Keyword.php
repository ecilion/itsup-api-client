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

namespace Itsup\Api\Model\Metrics;

use Itsup\Api\Annotation\Transform;
use Itsup\Api\Model\AbstractModel;
use Itsup\Api\Model\Campaign;

/**
 * @author Alex VASIC <alex@quantox.com>
 *
 * @method int getId()
 * @method string getName()
 * @method Campaign getCampaign()
 * @method setId(int $id)
 * @method setName(string $name)
 * @method setCampaign(Campaign $campaign)
 */
class Keyword extends AbstractModel
{
    /**
     * @var int
     * @Transform("int")
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var Campaign
     * @Transform("class", class="Itsup\Api\Model\Campaign")
     */
    public $campaign;
}
