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
 * @method string getStatus()
 * @method Contact getContact()
 * @method string getHosting()
 * @method string getType()
 * @method int getWidth()
 * @method int getHeight()
 * @method string getStatus()
 * @method string getDisplay()
 * @method Campaign getDefaultCampaign()
 * @method Account\ExternalStatisticsProvider getExternalStatisticsProvider()
 * @method string getExternalStatisticsId()
 * @method string getExternalStatisticsIdComplement()
 * @method string getExternalStatisticsOptions()
 * @method \DateTime getDateCreated()
 * @method \DateTime getCreatedBy()
 * @method \DateTime getDateUpdated()
 * @method User getCreatedBy()
 * @method User getUpdatedBy()
 * @method string getAccounting()
 * @method string getCampaigns()
 * @method string getNotes()
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
     * @var Campaign
     * @Transform("class", class="Itsup\Api\Model\Campaign")
     */
    public $defaultCampaign;

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
     * @var int
     * @Transform("int")
     */
    public $externalStatisticsId;

    /**
     * @var Account\ExternalStatisticsProvider[]
     * @Transform("class", class="Itsup\Api\Model\Account\ExternalStatisticsProvider", collection=true)
     */
    public $externalStatisticsProvider;

    /**
     * @var string
     */
    public $externalStatisticsIdComplement;

    /**
     * @var string
     */
    public $externalStatisticsOptions;

    /**
     * @var \DateTime
     * @Transform("date")
     */
    public $dateCreated;

    /**
     * @var \DateTime
     * @Transform("date")
     */
    public $dateUpdated;
}
