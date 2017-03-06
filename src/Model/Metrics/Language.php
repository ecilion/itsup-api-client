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

namespace Itsup\Api\Model\Metrics;

use Itsup\Api\Annotation\Transform;
use Itsup\Api\Model\AbstractModel;

/**
 * @author Cyril LEGRAND <cyril@sctr.net>
 *
 * @method string getId()
 * @method string getName()
 * @method int getPosition()
 * @method setId(string $id)
 * @method setName(string $name)
 * @method setPosition(int $position)
 */
class Language extends AbstractModel
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     * @Transform("int")
     */
    public $position;
}
