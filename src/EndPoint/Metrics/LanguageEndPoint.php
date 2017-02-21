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

namespace Itsup\Api\EndPoint\Metrics;

use Itsup\Api\EndPoint\AbstractEntityEndPoint;

/**
 * @author Cyril LEGRAND <cyril@sctr.net>
 */
class LanguageEndPoint extends AbstractEntityEndPoint
{
    /**
     * The model name.
     *
     * @var string
     */
    protected $model = 'Metrics\Language';

    /**
     * The API URI without the first "/".
     *
     * @var string
     */
    protected $route = 'metrics/language';
}
