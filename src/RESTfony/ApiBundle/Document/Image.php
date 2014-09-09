<?php

namespace RESTfony\ApiBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use RESTfony\ApiBundle\Helpers\UUID;


/** @MongoDB\Document */
class Image {
    /** @MongoDB\Id */
    protected $id;

    /** @MongoDB\String */
    protected $uuid;

    /** @MongoDB\String */
    protected $path;


    /**
     * Get id
     *
     * @return $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set uuid
     *
     * @param string $uuid
     * @return self
     */
    public function setUuid($uuid)
    {
        if(UUID::is_valid($uuid)) {
            $this->uuid = $uuid;
        } else {
            $this->genUuid();
        }
        return $this;
    }

    /**
     * Get uuid
     *
     * @return string $uuid
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return self
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * Get path
     *
     * @return string $path
     */
    public function getPath()
    {
        return $this->path;
    }

    public function genUuid() {
        $this->uuid = UUID::v4();
        return $this;
    }
}
