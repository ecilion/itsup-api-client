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
 * @method string getPayoutType()
 * @method string getStatisticUrl()
 * @method string getStatus()
 * @method array getTags()
 * @method array getNotes()
 */
class Offer extends AbstractModel
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
    public $payoutType;

    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $defaultValue;

    /**
     * @var string
     */
    public $statisticsUrl;

    /**
     * @var string
     */
    public $status;

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
}
