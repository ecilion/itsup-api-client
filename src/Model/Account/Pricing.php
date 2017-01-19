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
 * @method int getId()
 * @method Account getAccount()
 * @method \DateTime getFrom()
 * @method \DateTime getTo()
 * @method bool getCpm()
 * @method setId(int $id)
 * @method setAccount(Account $account)
 * @method setFrom(\DateTime $from)
 * @method setTo(\DateTime $to)
 * @method setCpm(bool $cpm)
 */
class Pricing extends AbstractModel
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
     * @var \DateTime
     * @Transform("date")
     */
    public $from;

    /**
     * @var \DateTime
     * @Transform("date")
     */
    public $to;

    /**
     * @var bool
     * @Transform("bool")
     */
    public $cpm;

    public function isCpm(): bool
    {
        return $this->cpm;
    }
}
