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
 * @author Cyril LEGRAND <cyril@sctr.net>
 */
class CampaignEndPoint extends AbstractTagEndPoint
{
    /**
     * The model name.
     *
     * @var string
     */
    protected $model = 'Campaign';

    /**
     * Campaign properties that should not be send to the api.
     *
     * @var string[]
     */
    protected $propertiesNotToBeSend = [
        'dateCreated',
        'createdBy',
        'dateUpdated',
        'updatedBy',
        'followers',
        'notes',
        'creatives',
        'limits',
        'sales',
        'browsers',
        'devices',
        'countries',
        'internetServiceProviders',
        'languages',
        'operatingSystems',
    ];
}