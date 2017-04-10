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
 * @method Account getUser()
 * @method string getName()
 * @method string getEmail()
 * @method string getSkype()
 * @method string getPhone()
 * @method string getCompany()
 * @method string getCountry()
 * @method string getWebsiteUrl()
 * @method bool getPublisher()
 * @method bool getBroker()
 * @method bool getAdvertiser()
 * @method string getComment()
 * @method setId(int $id)
 * @method setAccount(Account $account)
 * @method setUser(User $user)
 * @method setName(string $name)
 * @method setEmail(string $email)
 * @method setSkype(string $skype)
 * @method setPhone(string $phone)
 * @method setCompany(string $company)
 * @method setCountry(string $country)
 * @method setWebsiteUrl(string $websiteUrl)
 * @method setPublisher(bool $publisher)
 * @method setBroker(bool $broker)
 * @method setAdvertiser(bool $advertiser)
 * @method setComment(string $comment)
 */
class Contact extends AbstractModel
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
     * @var User
     * @Transform("class", class="Itsup\Api\Model\User")
     */
    public $user;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $skype;

    /**
     * @var string
     */
    public $phone;

    /**
     * @var string
     */
    public $company;

    /**
     * @var string
     */
    public $country;

    /**
     * @var string
     */
    public $websiteUrl;

    /**
     * @var bool
     * @Transform("bool")
     */
    public $publisher;

    /**
     * @var bool
     * @Transform("bool")
     */
    public $broker;

    /**
     * @var bool
     * @Transform("bool")
     */
    public $advertiser;

    /**
     * @var string
     */
    public $comment;

    /**
     * @return bool
     */
    public function isPublisher()
    {
        return $this->publisher;
    }

    /**
     * @return bool
     */
    public function isBroker()
    {
        return $this->broker;
    }

    /**
     * @return bool
     */
    public function isAdvertiser()
    {
        return $this->advertiser;
    }
}
