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

/**
 * @author Cyril LEGRAND <cyril@sctr.net>
 *
 * @method int getId()
 * @method string getName()
 * @method string getToken()
 * @method string getUsername()
 * @method string getPassword()
 * @method bool getValid()
 */
class ExternalStatisticsProvider extends AbstractModel
{
    /**
     * @var int
     * @Transform("int")
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $token;

    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $password;

    /**
     * @var bool
     * @Transform("bool")
     */
    public $valid;

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->valid;
    }
}
