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

namespace Itsup\Api\EndPoint;

/**
 * @author Cyril LEGRAND <cyril@sctr.net>
 */
class BrowserEndPoint extends AbstractEntityEndPoint
{
    /**
     * The model name.
     *
     * @var string
     */
    protected $model = 'Browser';

    /**
     * The API URI without the first "/".
     *
     * @var string
     */
    protected $route = 'metrics/browser';
}
