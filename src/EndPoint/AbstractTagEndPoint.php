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

/**
 * @author Cyril LEGRAND <cyril@sctr.net>
 */
abstract class AbstractTagEndPoint extends AbstractEntityEndPoint
{
    /**
     * Set an object tags using the API.
     *
     * @param AbstractModel  $object
     * @param array|string[] $tags
     *
     * @return bool|AbstractModel
     */
    public function setTags(AbstractModel $object, array $tags = [])
    {
        return $this->handleRequest(
            'POST',
            $this->getRoute().'/'.$object->getId().'/tag',
            ['tags' => $tags]
        );
    }
}
