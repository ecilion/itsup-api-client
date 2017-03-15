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
 * @method bool getCpm()
 * @method setAccount(Account $account)
 * @method setDate(\DateTime $date)
 * @method setCpm(bool $cpm)
 */
class Pricing extends AbstractModel
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
     * @var double
     */
    public $cpm;
}
