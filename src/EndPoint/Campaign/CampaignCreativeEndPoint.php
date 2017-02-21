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

/**
 * @author Cyril LEGRAND <cyril@sctr.net>
 */
class CampaignCreativeEndPoint extends AbstractEntityEndPoint
{
    /**
     * The model name.
     *
     * @var string
     */
    protected $model = 'Campaign\CampaignCreative';

    /**
     * The API URI without the first "/".
     *
     * @var string
     */
    protected $route = 'campaign/creative';
}
