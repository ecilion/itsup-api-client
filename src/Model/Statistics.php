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
 * @method array getType()
 * @method string getStart()
 * @method string getEnd()
 * @method array getGroup()
 * @method array getAdZone()
 * @method array getCampaign()
 * @method array getEvent()
 * @method array getCreative()
 * @method array getDevice()
 * @method array getCountry()
 * @method array getLanguage()
 * @method array getBrowser()
 * @method array getOs()
 * @method array getIsp()
 * @method array getGroupBy()
 * @method array getSortBy()
 * @method setType(array $type)
 * @method setStart(string $date)
 * @method setEnd(string $date)
 * @method setGroup(array $group)
 * @method setAdZone(array $adZone)
 * @method setCampaign(array $campaign)
 * @method setEvent(array $event)
 * @method setCreative(array $creative)
 * @method setDevice(array $device)
 * @method setCountry(array $country)
 * @method setLanguage(array $language)
 * @method setBrowser(array $browser)
 * @method setOs(array $os)
 * @method setIsp(array $isp)
 * @method setGroupBy(array $groupBy)
 * @method setSortBy(array $sortBY)
 */
class Statistics extends AbstractModel
{
    /**
     * @var array
     * @Transform("string", collection=true)
     */
    public $type;

    /**
     * @var string
     */
    public $start;

    /**
     * @var string
     */
    public $end;

    /**
     * @var array
     * @Transform("string", collection=true)
     */
    public $group;

    /**
     * @var array
     * @Transform("string", collection=true)
     */
    public $adZone;

    /**
     * @var array
     * @Transform("string", collection=true)
     */
    public $campaign;

    /**
     * @var array
     * @Transform("string", collection=true)
     */
    public $creative;

    /**
     * @var array
     * @Transform("string", collection=true)
     */
    public $event;

    /**
     * @var array
     * @Transform("string", collection=true)
     */
    public $device;

    /**
     * @var array
     * @Transform("string", collection=true)
     */
    public $country;

    /**
     * @var array
     * @Transform("string", collection=true)
     */
    public $language;

    /**
     * @var array
     * @Transform("string", collection=true)
     */
    public $browser;

    /**
     * @var array
     * @Transform("string", collection=true)
     */
    public $os;

    /**
     * @var array
     * @Transform("string", collection=true)
     */
    public $isp;

    /**
     * @var array
     * @Transform("string", collection=true)
     */
    public $groupBy;

    /**
     * @var array
     * @Transform("string", collection=true)
     */
    public $sortBy;

    /**
     * Accepted $value: [property => 'ASC|DESC'], 'property,ASC|DESC' and 'property' will set default to 'ASC'.
     *
     * @param mixed $value
     */
    public function addSortBy(mixed $value)
    {
        if (is_array($value)) {
            if (count($value) === 2) {
                $this->sortBy[] = [$value[0] => $value[1]];
            } else {
                $this->sortBy[] = $value;
            }
        } else {
            $value = explode(',', $value);
            $this->sortBy[] = [$value[0] => $value[1] ?? 'ASC'];
        }
    }
}
