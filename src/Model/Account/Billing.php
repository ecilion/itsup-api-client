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

namespace Itsup\Api\Model\Account;

use Itsup\Api\Annotation\Transform;
use Itsup\Api\Model\AbstractModel;
use Itsup\Api\Model\Account;

/**
 * @author Cyril LEGRAND <cyril@sctr.net>
 *
 * @method Account getAccount()
 * @method \DateTime getDate()
 * @method int getImpressions()
 * @method int getClicks()
 * @method int getEvents()
 * @method float getPrice()
 *
 * @method setAccount(Account $Account)
 * @method setDate(\DateTime $date)
 * @method setImpressions(int $impressions)
 * @method setClicks(int $clicks)
 * @method setEvents(int $events)
 * @method setPrice(float $price)
 */
class Billing extends AbstractModel
{
    /**
     * @var Account
     * @Transform("class", class="Itsup\Api\Model\Account")
     */
    public $account;

    /**
     * @var \DateTime
     * @Transform("date")
     */
    public $date;

    /**
     * @var int
     * @Transform("int")
     */
    public $impressions;

    /**
     * @var int
     * @Transform("int")
     */
    public $clicks;

    /**
     * @var int
     * @Transform("int")
     */
    public $events;

    /**
     * @var float
     * @Transform("float")
     */
    public $price;
}
