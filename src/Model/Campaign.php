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

namespace Itsup\Api\Model;

use Itsup\Api\Annotation\Transform;

/**
 * @author Cyril LEGRAND <cyril@sctr.net>
 *
 * @method int getId()
 * @method Account getAccount()
 * @method Offer getOffer()
 * @method string getName()
 * @method string getRevenue()
 * @method Campaign getFallbackCampaign()
 * @method Event getEvent()
 * @method string getType()
 * @method int getWidth()
 * @method int getHeight()
 * @method string getUrl()
 * @method string getStatus()
 * @method \DateTime getDateCreated()
 * @method User getCreatedBy()
 * @method \DateTime getDateUpdated()
 * @method User getUpdatedBy()
 * @method array|Metrics\Browser[] getBrowsers()
 * @method array|Metrics\Country[] getCountries()
 * @method array|Metrics\Device[] getDevices()
 * @method array|Metrics\InternetServiceProvider[] getInternetServiceProviders()
 * @method array|Metrics\Language[] getLanguages()
 * @method array|Metrics\OperatingSystem[] getOperatingSystems()
 * @method array|Metrics\Keyword[] getKeywords()
 * @method array|Campaign\CampaignCreative[] getCreatives()
 * @method array|Campaign\Limit[] getLimits()
 * @method array|Campaign\Sale[] getSales()
 * @method bool getKeepAlive()
 * @method array|Note[] getNotes()
 * @method array|Tag[] getTags()
 * @method array|User[] getFollowers()
 * @method array|AdZone\AdZoneCampaign getAdZones()
 * @method array|Campaign\Group getGroups()
 * @method setId(int $id)
 * @method setAccount(Account $account)
 * @method setOffer(Offer $offer)
 * @method setName(string $name)
 * @method setRevenue(string $revenue)
 * @method setFallbackCampaign(Campaign $fallbackCampaign)
 * @method setEvent(Event $event)
 * @method setType(string $type)
 * @method setWidth(int $width)
 * @method setHeight(int $height)
 * @method setUrl(string $url)
 * @method setStatus(string $status)
 * @method setDateCreated(\DateTime $dateCreated)
 * @method setCreatedBy(User $createdBy)
 * @method setDateUpdated(\DateTime $dateUpdated)
 * @method setUpdatedBy(User $updatedBy)
 * @method setBrowsers(array|Metrics\Browser[] $browsers)
 * @method setCountries(array|Metrics\Country[] $countries)
 * @method setDevices(array|Metrics\Country[] $devices)
 * @method setInternetServiceProviders(array|Metrics\InternetServiceProvider[] $internetServiceProviders)
 * @method setLanguages(array|Metrics\Language[] $languages)
 * @method setOperatingSystems(array|Metrics\OperatingSystem[] $operatingSystems)
 * @method setKeywords(array|Metrics\Keyword[] $keywords)
 * @method setCreatives(array|Campaign\CampaignCreative[] $creatives)
 * @method setLimits(array|Campaign\Limit[] $limits)
 * @method setSales(array|Campaign\Sale[] $sales)
 * @method setKeepAlive(bool $keepAlive)
 * @method setNotes(array|Note[] $notes)
 * @method setTags(array|Tag[] $tags)
 * @method setFollowers(array|User[] $followers)
 * @method setAdZones(array|AdZone\AdZoneCampaign[] $adZones)
 * @method setGroups(array|Campaign\Group[] $groups)
 */
class Campaign extends AbstractModel
{
    /**
     * @var int
     * @Transform("int")
     */
    public $id;

    /**
     * @var Account
     * @Transform("class", class="Itsup\Api\Model\Account")
     */
    public $account;

    /**
     * @var Offer
     * @Transform("class", class="Itsup\Api\Model\Offer")
     */
    public $offer;

    /**
     * @var AdZone[]
     * @Transform("class", class="Itsup\Api\Model\AdZone\AdZoneCampaign", collection=true)
     */
    public $adZones;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $revenue;

    /**
     * @var bool
     * @Transform("bool")
     */
    public $keepAlive;

    /**
     * @var Campaign
     * @Transform("class", class="Itsup\Api\Model\Campaign")
     */
    public $fallbackCampaign;

    /**
     * @var Event
     * @Transform("class", class="Itsup\Api\Model\Event")
     */
    public $event;

    /**
     * @var string
     */
    public $type;

    /**
     * @var int
     * @Transform("int")
     */
    public $width;

    /**
     * @var int
     * @Transform("int")
     */
    public $height;

    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $status;

    /**
     * @var User
     * @Transform("class", class="Itsup\Api\Model\User")
     */
    public $createdBy;

    /**
     * @var \DateTime
     * @Transform("date")
     */
    public $dateCreated;

    /**
     * @var User
     * @Transform("class", class="Itsup\Api\Model\User")
     */
    public $updatedBy;

    /**
     * @var \DateTime
     * @Transform("date")
     */
    public $dateUpdated;

    /**
     * @var Metrics\Browser[]
     * @Transform("class", class="Itsup\Api\Model\Metrics\Browser", collection=true)
     */
    public $browsers;

    /**
     * @var Metrics\Country[]
     * @Transform("class", class="Itsup\Api\Model\Metrics\Country", collection=true)
     */
    public $countries;

    /**
     * @var Metrics\Device[]
     * @Transform("class", class="Itsup\Api\Model\Metrics\Device", collection=true)
     */
    public $devices;

    /**
     * @var Metrics\InternetServiceProvider[]
     * @Transform("class", class="Itsup\Api\Model\Metrics\InternetServiceProvider", collection=true)
     */
    public $internetServiceProviders;

    /**
     * @var Metrics\Language[]
     * @Transform("class", class="Itsup\Api\Model\Metrics\Language", collection=true)
     */
    public $languages;

    /**
     * @var Metrics\OperatingSystem[]
     * @Transform("class", class="Itsup\Api\Model\Metrics\OperatingSystem", collection=true)
     */
    public $operatingSystems;

    /**
     * @var Metrics\Keyword[]
     * @Transform("class", class="Itsup\Api\Model\Metrics\Keyword", collection=true)
     */
    public $keywords;

    /**
     * @var Campaign\CampaignCreative[]
     * @Transform("class", class="Itsup\Api\Model\Campaign\CampaignCreative", collection=true)
     */
    public $creatives;

    /**
     * @var Campaign\Limit[]
     * @Transform("class", class="Itsup\Api\Model\Campaign\Limit", collection=true)
     */
    public $limits;

    /**
     * @var Campaign\Sale[]
     * @Transform("class", class="Itsup\Api\Model\Campaign\Sale", collection=true)
     */
    public $sales;

    /**
     * @var array
     * @Transform("class", class="Itsup\Api\Model\Tag", collection=true)
     */
    public $tags;

    /**
     * @var array
     * @Transform("class", class="Itsup\Api\Model\Note", collection=true)
     */
    public $notes;

    /**
     * @var array
     * @Transform("class", class="Itsup\Api\Model\User", collection=true)
     */
    public $followers;

    /**
     * @var array
     * @Transform("class", class="Itsup\Api\Model\Campaign\Group", collection=true)
     */
    public $groups;

    /**
     * @return bool
     */
    public function isKeepAlive(): bool
    {
        return $this->keepAlive ? true : false;
    }

    /**
     * @return Metrics\InternetServiceProvider[]
     */
    public function getIsp()
    {
        return $this->internetServiceProviders;
    }

    /**
     * @return Metrics\OperatingSystem[]
     */
    public function getOs()
    {
        return $this->operatingSystems;
    }
}
