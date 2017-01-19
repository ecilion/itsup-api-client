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
 * @method string getOfficialName()
 * @method string getCountryCode3()
 * @method string getRegion()
 * @method string getSubRegion()
 * @method int getPosition()
 *
 * @method setId(int $id)
 * @method setName(string $name)
 * @method setOfficialName(string $officialName)
 * @method setCountryCode3(string $countryCode3)
 * @method setRegion(string $region)
 * @method setSubRegion(string $subRegion)
 * @method setPosition(int $position)
 */
class Country extends AbstractModel
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
    public $officialName;

    /**
     * @var string
     */
    public $countryCode3;

    /**
     * @var string
     */
    public $region;

    /**
     * @var string
     */
    public $subRegion;

    /**
     * @var int
     * @Transform("int")
     */
    public $position;
}
