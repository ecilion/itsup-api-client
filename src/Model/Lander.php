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
 * @author Alex VASIC <alex@quantox.com>
 *
 * @method int getId()
 * @method Account getAccount()
 * @method string getName()
 * @method string getUrl()
 * @method string getStatus()
 * @method \DateTime getDateCreated()
 * @method array getOffers()
 * @method setId(int $id)
 * @method setAccount(Account $account)
 * @method setName(string $name)
 * @method setUrl(string $url)
 * @method setStatus(string $status)
 * @method setDateCreated(\DateTime $dateCreated)
 * @method setOffers(Offer $offer)
 */
class Lander extends AbstractModel
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
     * @var string
     */
    public $name;

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
     * @var array
     * @Transform("class", class="Itsup\Api\Model\Offer", collection=true)
     */
    public $offers;
}
