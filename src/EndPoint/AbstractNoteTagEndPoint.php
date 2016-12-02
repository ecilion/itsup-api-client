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

use Itsup\Api\Model\AbstractModel;
use Itsup\Api\Model\Note;

/**
 * @author Cyril LEGRAND <cyril@sctr.net>
 */
abstract class AbstractNoteTagEndpoint extends AbstractEntityEndpoint
{
    /**
     * Set an object tags using the API.
     *
     * @param AbstractModel  $object
     * @param array|string[] $tags
     *
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

    /**
     * Add a note to an object using the API.
     *
     * @param AbstractModel  $object
     * @param Note           $note
     *
     *
     * @return bool|AbstractModel
     */
    public function addNote(AbstractModel $object, Note $note)
    {
        return $this->handleRequest(
            'POST',
            $this->getRoute().'/'.$object->getId().'/note',
            $this->formatObjectToPost($note)
        );
    }

    /**
     * Remove a note from an object using the API.
     *
     * @param AbstractModel  $object
     * @param Note           $note
     *
     *
     * @return bool|AbstractModel
     */
    public function removeNote(AbstractModel $object, Note $note)
    {
        return $this->handleRequest(
            'DELETE',
            $this->getRoute().'/'.$object->getId().'/note/'.$note->getId()
        );
    }
}
