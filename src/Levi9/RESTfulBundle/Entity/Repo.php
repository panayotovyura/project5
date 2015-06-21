<?php

namespace Levi9\RESTfulBundle\Entity;

use JMS\Serializer\Annotation\Type;

/**
 * Class Repo
 * @package Levi9\RESTfulBundle\Entity
 * @SuppressWarnings(PHPMD.ShortVariable)
 */
class Repo
{
    /**
     * @Type("integer")
     */
    private $id;

    /**
     * @Type("string")
     */
    private $name;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
