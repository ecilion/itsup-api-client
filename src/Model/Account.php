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
 * @method string getType()
 * @method string getName()
 * @method string getAddress()
 * @method string getAddressComplement()
 * @method string getCity()
 * @method string getZipCode()
 * @method string getState()
 * @method string getCountry()
 * @method string getTaxId()
 * @method string getWebSiteUrl()
 * @method string getInvoiceFrom()
 * @method bool getEnabled()
 * @method array getDomains()
 * @method array getPricing()
 * @method array getBilling()
 * @method array getExternalStatisticsProviders()
 *
 * @method setId(int $id)
 * @method setType(string $type)
 * @method setName(string $name)
 * @method setAddress(string $address)
 * @method setAddressComplement(string $addressComplement)
 * @method setCity(string $city)
 * @method setZipCode(string $zipCode)
 * @method setState(string $state)
 * @method setCountry(string $country)
 * @method setTaxId(string $taxId)
 * @method setWebSiteUrl(string $websiteUrl)
 * @method setInvoiceFrom(string $invoiceFrom)
 * @method setEnabled(bool $enabled)
 * @method setDomains(array $domains)
 * @method setPricing(array $pricing)
 * @method setBilling(array $billing)
 * @method setExternalStatisticsProviders(array $externalStatisticsProviders)
 */
class Account extends AbstractModel
{
    /**
     * @var int
     * @Transform("int")
     */
    public $id;

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $address;

    /**
     * @var string
     */
    public $addressComplement;

    /**
     * @var string
     */
    public $city;

    /**
     * @var string
     */
    public $zipCode;

    /**
     * @var string
     */
    public $state;

    /**
     * @var string
     */
    public $country;

    /**
     * @var string
     */
    public $taxId;

    /**
     * @var string
     */
    public $websiteUrl;

    /**
     * @var string
     */
    public $invoiceFrom;

    /**
     * @var int
     * @Transform("bool")
     */
    public $enabled;

    /**
     * @var Account\Domain[]
     * @Transform("class", class="Itsup\Api\Model\Account\Domain", collection=true)
     */
    public $domains;

    /**
     * @var Account\Pricing[]
     * @Transform("class", class="Itsup\Api\Model\Account\Pricing", collection=true)
     */
    public $pricing;

    /**
     * @var Account\Billing[]
     * @Transform("class", class="Itsup\Api\Model\Account\Billing", collection=true)
     */
    public $billing;

    /**
     * @var Account\ExternalStatisticsProvider[]
     * @Transform("class", class="Itsup\Api\Model\Account\ExternalStatisticsProvider", collection=true)
     */
    public $externalStatisticsProviders;
}
