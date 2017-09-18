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
 * @author Alex VASIC <alex@quantox.com>
 *
 * @method int getId()
 * @method string getName()
 * @method string getParameters()
 * @method setId(int $id)
 * @method setName(string $name)
 * @method setParameters(string $parameters)
 */
class BackgroundJob extends AbstractModel
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
    public $parameters;
}
