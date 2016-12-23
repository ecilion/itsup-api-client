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
use Itsup\Api\Client;

AnnotationRegistry::registerLoader([$loader, 'loadClass']);

$client = new Client(
    [
        'scheme'    => 'http',
        'host'      => 'dev.api.itsup.com',
        'api_key'   => 'YzEzYmMyOTlmMjU5ZDM4MGFmN2I5OWE3MTdmZDNhNTQzMGEzZjEyMw==',
        'cache_dir' => __DIR__.'/cache/',
    ]
);

$user = new \Itsup\Api\Model\User();
$user->setUsername('apiAdmin');

var_dump($client->user->find($user));

var_dump($client->user->getByUsername('apiAdmin'));

var_dump($client->user->login('apiAdmin'));