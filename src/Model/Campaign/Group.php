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

namespace Itsup\Api\Model\Campaign;

use Itsup\Api\Annotation\Transform;
use Itsup\Api\Model\AbstractModel;
use Itsup\Api\Model\Account;
use Itsup\Api\Model\Campaign;

/**
 * @author Alex VASIC <alex@quantox.com>
 *
 * @method int getId()
 * @method Account getAccount()
 * @method string getName()
 * @method string getStatus()
 * @method array|Campaign[] getCampaigns()
 * @method setId(int $id)
 * @method setAccount(Account $account)
 * @method setName(string $name)
 * @method setStatus(string $status)
 * @method setCampaigns(array|Campaign[] $campaigns)
 */
class Group extends AbstractModel
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
    public $status;

    /**
     * @var array
     * @Transform("class", class="Itsup\Api\Model\Campaign", collection=true)
     */
    public $campaigns;
}
