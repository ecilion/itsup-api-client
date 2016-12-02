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

namespace Itsup\Api\Endpoint;

/**
 * @author Cyril LEGRAND <cyril@sctr.net>
 */
class AccountEndPoint extends AbstractEntityEndPoint
{
    /**
     * The model name.
     *
     * @var string
     */
    protected $model = 'Account';

    /**
     * The API URI without the first "/".
     *
     * @var string
     */
    protected $route = 'account';
}
