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
 * @method User getUser()
 * @method string getText()
 * @method \DateTime getDate()
 */
class Note extends AbstractModel
{
    /**
     * @var int
     * @Transform("int")
     */
    public $id;

    /**
     * @var User
     * @Transform("class", class="Itsup\Api\Model\User")
     */
    public $user;

    /**
     * @var string
     */
    public $text;

    /**
     * @var \DateTime
     * @Transform("date")
     */
    public $date;
}
