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
 * @method string getType()
 * @method string getName()
 * @method bool getSsl()
 * @method bool getDefaultDomain()
 * @method bool getInstalled()
 * @method setId(int $id)
 * @method setAccount(Account $Account)
 * @method setType(string $type)
 * @method setName(string $name)
 * @method setSsl(bool $ssl)
 * @method setDefaultDomain(bool $defaultDomain)
 * @method setInstalled(bool $installed)
 */
class Domain extends AbstractModel
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
    public $type;

    /**
     * @var string
     */
    public $name;

    /**
     * @var bool
     * @Transform("bool")
     */
    public $ssl;

    /**
     * @var bool
     * @Transform("bool")
     */
    public $defaultDomain;

    /**
     * @var bool
     * @Transform("bool")
     */
    public $installed;

    /**
     * @return bool
     */
    public function isSsl(): bool
    {
        return $this->ssl;
    }

    /**
     * @return bool
     */
    public function isDefaultDomain(): bool
    {
        return $this->defaultDomain;
    }

    /**
     * @return bool
     */
    public function isInstalled(): bool
    {
        return $this->installed;
    }
}
