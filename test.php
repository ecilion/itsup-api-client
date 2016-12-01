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

$loader = require_once __DIR__.'/../../autoload.php';

use Doctrine\Common\Annotations\AnnotationRegistry;
use Sctr\Bang\Api\Client;

AnnotationRegistry::registerLoader([$loader, 'loadClass']);

$client = new Client(
    [
        'scheme'    => 'http',
        'host'      => 'dev.api.bang.com',
        'api_key'   => 'NTA1MjE2MmU2Y2I0MGU0MjZjZTMxM2FhNzI1MGY5NDBmZWYxMDUwZg==',
        'cache_dir' => __DIR__.'/cache/',
    ]
);

var_dump($client->geoip->getCity('76.167.242.198'));

/*
//$customer = $client->customer->getByCustomerId(374001);
$customer = $client->customer->getByEmailOrUsername('hightime2211@gmail.com');

$password = strip_tags(strtolower(trim('rav740x')));
$password = substr(str_replace(' ', '', str_replace('"', '', str_replace("\n", '', $password))), 0, 128);

$password = sha1($password);

dump($customer, $customer->getPassword(), $password);
*/
