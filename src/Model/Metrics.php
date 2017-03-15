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
 * @method array|Metrics\Browser[] getBrowsers()
 * @method array|Metrics\Country[] getCountries()
 * @method array|Metrics\Device[] getDevices()
 * @method array|Metrics\InternetServiceProvider[] getInternetServiceProviders()
 * @method array|Metrics\Language[] getLanguages()
 * @method array|Metrics\OperatingSystem[] getOperatingSystems()
 * @method setBrowsers(array|Metrics\Browser[] $browsers)
 * @method setCountries(array|Metrics\Country[] $countries)
 * @method setDevices(array|Metrics\Country[] $devices)
 * @method setInternetServiceProviders(array|Metrics\InternetServiceProvider[] $internetServiceProviders)
 * @method setLanguages(array|Metrics\Language[] $languages)
 * @method setOperatingSystems(array|Metrics\OperatingSystem[] $operatingSystems)
 */
class Metrics extends AbstractModel
{
    /**
     * @var Metrics\Browser[]
     * @Transform("class", class="Itsup\Api\Model\Metrics\Browser", collection=true)
     */
    public $browsers;

    /**
     * @var Metrics\Country[]
     * @Transform("class", class="Itsup\Api\Model\Metrics\Country", collection=true)
     */
    public $countries;

    /**
     * @var Metrics\Device[]
     * @Transform("class", class="Itsup\Api\Model\Metrics\Device", collection=true)
     */
    public $devices;

    /**
     * @var Metrics\InternetServiceProvider[]
     * @Transform("class", class="Itsup\Api\Model\Metrics\InternetServiceProvider", collection=true)
     */
    public $internetServiceProviders;

    /**
     * @var Metrics\Language[]
     * @Transform("class", class="Itsup\Api\Model\Metrics\Language", collection=true)
     */
    public $languages;

    /**
     * @var Metrics\OperatingSystem[]
     * @Transform("class", class="Itsup\Api\Model\Metrics\OperatingSystem", collection=true)
     */
    public $operatingSystems;
}
