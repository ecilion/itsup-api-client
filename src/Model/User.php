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
 * @method string getEmail()
 * @method string getUsername()
 * @method string getPassword()
 * @method string getSalt()
 * @method array getRoles()
 * @method string getName()
 * @method string getPhone()
 * @method string getSkype()
 * @method string getTimezone()
 * @method string getApiKey()
 * @method bool getEnabled()
 */
class User extends AbstractModel
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
    public $email;

    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $password;

    /**
     * @var string
     */
    public $salt;

    /**
     * @var array
     * @Transform("string", collection=true)
     */
    public $roles;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $phone;

    /**
     * @var string
     */
    public $skype;

    /**
     * @var string
     */
    public $timezone;

    /**
     * @var string
     */
    public $apiKey;

    /**
     * @var bool
     * @Transform("bool")
     */
    public $enabled;

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }
}
