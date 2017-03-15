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

namespace Itsup\Api\EndPoint\Account;

use Itsup\Api\EndPoint\AbstractEntityEndPoint;
use Itsup\Api\Model\AbstractModel;

/**
 * @author Cyril LEGRAND <cyril@sctr.net>
 */
class PricingEndPoint extends AbstractEntityEndPoint
{
    /**
     * The model name.
     *
     * @var string
     */
    protected $model = 'Account\Pricing';

    /**
     * The API URI without the first "/".
     *
     * @var string
     */
    protected $route = 'account/pricing';

    /**
     * Delete an object using the API.
     *
     * @param AbstractModel $object
     *
     * @return bool|AbstractModel
     */
    public function delete(AbstractModel $object)
    {
        return $this->handleRequest(
            'DELETE',
            $this->getRoute(),
            [
                'account' => $object->getAccount(),
                'date'    => $object->getDate(),
            ]
        );
    }
}
