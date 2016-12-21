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

use Doctrine\Common\Collections\ArrayCollection;
use Itsup\Api\Model\AbstractModel;
use Itsup\Api\Model\Campaign;

/**
 * @author Cyril LEGRAND <cyril@sctr.net>
 */
class CampaignEndPoint extends AbstractNoteFollowerEndPoint
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

    /**
     * @param Campaign        $campaign
     * @param ArrayCollection $countries
     *
     * @return array|bool|AbstractModel
     */
    public function setCountry(Campaign $campaign, ArrayCollection $countries)
    {
        return $this->handleRequest(
            'POST',
            $this->getRoute().'/'.$campaign->getId().'/country',
            $this->formatObjectToIds($countries, true)
        );
    }

    /**
     * @param Campaign        $campaign
     * @param ArrayCollection $isps
     *
     * @return array|bool|AbstractModel
     */
    public function setInternetServiceProvider(Campaign $campaign, ArrayCollection $isps)
    {
        return $this->handleRequest(
            'POST',
            $this->getRoute().'/'.$campaign->getId().'/isp',
            $this->formatObjectToIds($isps, true)
        );
    }

    /**
     * @param Campaign        $campaign
     * @param ArrayCollection $oses
     *
     * @return array|bool|AbstractModel
     */
    public function setOperatingSystem(Campaign $campaign, ArrayCollection $oses)
    {
        return $this->handleRequest(
            'POST',
            $this->getRoute().'/'.$campaign->getId().'/os',
            $this->formatObjectToIds($oses, true)
        );
    }

    /**
     * @param Campaign        $campaign
     * @param ArrayCollection $browsers
     *
     * @return array|bool|AbstractModel
     */
    public function setBrowser(Campaign $campaign, ArrayCollection $browsers)
    {
        return $this->handleRequest(
            'POST',
            $this->getRoute().'/'.$campaign->getId().'/browsers',
            $this->formatObjectToIds($browsers, true)
        );
    }

    /**
     * @param Campaign        $campaign
     * @param ArrayCollection $devices
     *
     * @return array|bool|AbstractModel
     */
    public function setDevice(Campaign $campaign, ArrayCollection $devices)
    {
        return $this->handleRequest(
            'POST',
            $this->getRoute().'/'.$campaign->getId().'/browsers',
            $this->formatObjectToIds($devices, true)
        );
    }

    /**
     * @param Campaign        $campaign
     * @param ArrayCollection $languages
     *
     * @return array|bool|AbstractModel
     */
    public function setLanguage(Campaign $campaign, ArrayCollection $languages)
    {
        return $this->handleRequest(
            'POST',
            $this->getRoute().'/'.$campaign->getId().'/browsers',
            $this->formatObjectToIds($languages, true)
        );
    }
}
