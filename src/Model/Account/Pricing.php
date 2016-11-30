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
 * @method \DateTime getFrom()
 * @method \DateTime getTo()
 * @method bool getCpm()
 */
class Pricing extends AbstractModel
{
    /**
     * @var int
     * @Transform("int")
     */
    public $id;

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
