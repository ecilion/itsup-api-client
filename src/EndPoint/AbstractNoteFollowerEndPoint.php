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

use Itsup\Api\Model\AbstractModel;
use Itsup\Api\Model\Follower;

/**
 * @author Alex VASIC <alex@quantox.com>
 */
abstract class AbstractNoteFollowerEndPoint extends AbstractNoteEndPoint
{
    /**
     * Add a note to an object using the API.
     *
     * @param AbstractModel $object
     * @param Follower      $follower
     *
     * @return bool|AbstractModel
     */
    public function addFollower(AbstractModel $object, Follower $follower)
    {
        return $this->handleRequest(
            'POST',
            $this->getRoute().'/'.$object->getId().'/follower/'.$follower->getId(),
            ['context' => $follower->getContext()]
        );
    }

    /**
     * Remove a note from an object using the API.
     *
     * @param AbstractModel $object
     * @param Follower      $follower
     *
     * @return bool|AbstractModel
     */
    public function removeFollower(AbstractModel $object, Follower $follower)
    {
        return $this->handleRequest(
            'DELETE',
            $this->getRoute().'/'.$object->getId().'/follower/'.$follower->getId()
        );
    }
}
