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
 * @method string getStatus()
 * @method string getName()
 * @method string getType()
 * @method string getCode()
 * @method int getWidth()
 * @method int getHeight()
 * @method int getSize()
 * @method \DateTime getDateCreated()
 * @method array|Tag[] getTags()
 * @method setId(int $id)
 * @method setAccount(Account $account)
 * @method setStatus(string $status)
 * @method setName(string $name)
 * @method setType(string $type)
 * @method setCode(string $code)
 * @method setWidth(int $width)
 * @method setHeight(int $height)
 * @method setSize(int $size)
 * @method setDateCreated(\DateTime $dateCreated)
 * @method setTags(array|Tag[] $tags)
 */
class Creative extends AbstractModel
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
    public $status;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $code;

    /**
     * @var int
     * @Transform("int")
     */
    public $width;

    /**
     * @var int
     * @Transform("int")
     */
    public $height;

    /**
     * @var int
     * @Transform("int")
     */
    public $size = 0;

    /**
     * @var \DateTime
     * @Transform("date")
     */
    public $dateCreated;

    /**
     * @var array
     * @Transform("class", class="Itsup\Api\Model\Tag", collection=true)
     */
    public $tags;
}
