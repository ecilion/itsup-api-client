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

namespace Itsup\Api\EndPoint;

/**
 * @author Alex VASIC <alex@quantox.com>
 */
class LanderEndPoint extends AbstractEndPoint
{
    /**
     * The model name.
     *
     * @var string
     */
    protected $model = 'Lander';

    /**
     * Lander properties that should not be send to the api.
     *
     * @var string[]
     */
    protected $propertiesNotToBeSent = [
        'offers',
    ];
}
