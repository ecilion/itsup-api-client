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
 * @method Campaign getCampaign()
 * @method Offer getOffer()
 * @method Contact getContact()
 * @method Event getEvent()
 * @method string getName()
 * @method string getRevenue()
 * @method bool isKeepAlive()
 * @method Campaign getFallbackCampaign()
 * @method string getType()
 * @method int getWidth()
 * @method int getHeight()
 * @method string getUrl()
 * @method string getStatus()
 * @method \DateTime getDateCreated()
 * @method \DateTime getDateUpdated()
 * @method User getCreatedBy()
 * @method User getUpdatedBy()
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
     * @var Contact
     * @Transform("class", class="Itsup\Api\Model\Offer")
     */

    public $offer;

    /**
     * @var Campaign
     * @Transform("class", class="Itsup\Api\Model\Campaign")
     */
    public $fallbackCampaignId;

    /**
     * @var Event
     * @Transform("class", class="Itsup\Api\Model\Event")
     */
    public $event;

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
    public $revenue;

    /**
     * @var bool
     * @Transform("bool")
     */
    public $keepAlive;

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
