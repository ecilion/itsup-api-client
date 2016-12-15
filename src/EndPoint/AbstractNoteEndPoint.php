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
use Itsup\Api\Model\Note;

/**
 * @author Cyril LEGRAND <cyril@sctr.net>
 */
abstract class AbstractNoteEndPoint extends AbstractEntityEndPoint
{
    /**
     * Add a note to an object using the API.
     *
     * @param AbstractModel $object
     * @param Note          $note
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
     * @param AbstractModel $object
     * @param Note          $note
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
