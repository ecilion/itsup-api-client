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
 * @method Contact getContact()
 * @method string getName()
 * @method string getHosting()
 * @method string getType()
 * @method int getWidth()
 * @method int getHeight()
 * @method string getStatus()
 * @method Campaign getDefaultCampaign()
 * @method string getDisplay()
 * @method Account\ExternalStatisticsProvider getExternalStatisticsProvider()
 * @method string getExternalStatisticsId()
 * @method string getExternalStatisticsIdComplement()
 * @method string getExternalStatisticsOptions()
 * @method \DateTime getDateCreated()
 * @method User getCreatedBy()
 * @method \DateTime getDateUpdated()
 * @method User getUpdatedBy()
 * @method array|AdZone\Accounting[] getAccounting()
 * @method array|AdZone\AdZoneCampaign[] getCampaigns()
 * @method array|Tag[] getTags()
 * @method array|Note[] getNotes()
 * @method array|User[] getFollowers()
 *
 * @method setId(int $id)
 * @method setAccount(Account $account)
 * @method setContact(Contact $contact)
 * @method setName(string $name)
 * @method setHosting(string $hosting)
 * @method setType(string $type)
 * @method setWidth(int $width)
 * @method setHeight(int $height)
 * @method setStatus(string $status)
 * @method setDefaultCampaign(Campaign $defaultCampaign)
 * @method setDisplay(string $display)
 * @method setExternalStatisticsProvider(Account\ExternalStatisticsProvider $externalStatisticsProvider)
 * @method setExternalStatisticsId(string $externalStatisticsId)
 * @method setExternalStatisticsIdComplement(string $externalStatisticsIdComplement)
 * @method setExternalStatisticsOptions(string $externalStatisticsOptions)
 * @method setDateCreated(\DateTime $dateCreated)
 * @method setCreatedBy(User $createdBy)
 * @method setDateUpdated(\DateTime $dateUpdated)
 * @method setUpdatedBy(User $updatedBy)
 * @method setAccounting(array|AdZone\Accounting[] $accounting)
 * @method setCampaigns(array|AdZone\AdZoneCampaign[] $campaigns)
 * @method setTags(array|Tag[] $tags)
 * @method setNotes(array|Note[] $notes)
 * @method setFollowers(array|User[] $followers)
 *
 */
class AdZone extends AbstractModel
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
     * @var Contact
     * @Transform("class", class="Itsup\Api\Model\Contact")
     */
    public $contact;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $hosting;

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
    public $status;

    /**
     * @var string
     */
    public $display;

    /**
     * @var Campaign
     * @Transform("class", class="Itsup\Api\Model\Campaign")
     */
    public $defaultCampaign;

    /**
     * @var Account\ExternalStatisticsProvider
     * @Transform("class", class="Itsup\Api\Model\Account\ExternalStatisticsProvider")
     */
    public $externalStatisticsProvider;

    /**
     * @var int
     * @Transform("int")
     */
    public $externalStatisticsId;

    /**
     * @var string
     */
    public $externalStatisticsIdComplement;

    /**
     * @var array
     */
    public $externalStatisticsOptions;

    /**
     * @var \DateTime
     * @Transform("date")
     */
    public $dateCreated;

    /**
     * @var User
     * @Transform("class", class="Itsup\Api\Model\User")
     */
    public $createdBy;

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
     * @var Adzone\Accounting[]
     * @Transform("class", class="Itsup\Api\Model\AdZone\Accounting", collection=true)
     */
    public $accounting;

    /**
     * @var Adzone\AdZoneCampaign[]
     * @Transform("class", class="Itsup\Api\Model\AdZone\AdZoneCampaign", collection=true)
     */
    public $campaigns;

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
}
