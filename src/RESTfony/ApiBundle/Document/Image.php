<?php

namespace RESTfony\ApiBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use RESTfony\ApiBundle\Helpers\UUID;

use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;



/**
 * @MongoDB\Document
 *
 * @ExclusionPolicy("all")
 */
class Image {
    /** @MongoDB\Id */
    protected $id;

    /**
     * @MongoDB\String
     * @Expose */
    protected $title;

    /**
     * @MongoDB\String
     * @Expose */
    protected $uuid;

    /**
     * @MongoDB\String
     * @Expose */
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
     * @param mixed $title
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
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
