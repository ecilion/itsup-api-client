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

use Itsup\Api\Model\User;

/**
 * @author Cyril LEGRAND <cyril@sctr.net>
 */
class UserEndPoint extends AbstractEntityEndPoint
{
    /**
     * The model name.
     *
     * @var string
     */
    protected $model = 'User';

    /**
     * User properties that should not be send to the api.
     *
     * @var string[]
     */
    protected $propertiesNotToBeSent = [
        'salt',
    ];

    /**
     * @param $emailOrUsername
     *
     * @return User
     */
    public function login($emailOrUsername)
    {
        $user = $this->getByUsername($emailOrUsername);
        if (false === $user && filter_var($emailOrUsername, FILTER_VALIDATE_EMAIL)) {
            $user = $this->getByEmail($emailOrUsername);
        }

        return $user;
    }

    /**
     * Returns all account followers.
     *
     * @param AbstractModel|array $params
     *
     * @throws ApiException
     *
     * @return bool|AbstractModel|array
     */
    public function listAll($params = [])
    {
        return $this->handleRequest(
            'GET',
            $this->getRoute().'/all',
            $this->formatParams($params),
            'array'
        );
    }
}
