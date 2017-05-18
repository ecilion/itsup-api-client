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
 * @method int getId()
 * @method string getName()
 * @method bool getSelected()
 * @method setId(int $id)
 * @method setName(string $name)
 * @method setSelected(bool $sel)
 */
class InternetServiceProvider extends AbstractModel
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
     * @var bool
     * @Transform("bool")
     */
    public $selected;

    /**
     * @return bool
     */
    public function isSelected()
    {
        return $this->selected;
    }
}
