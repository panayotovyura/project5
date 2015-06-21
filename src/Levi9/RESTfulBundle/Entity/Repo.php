<?php

namespace Levi9\RESTfulBundle\Entity;

use JMS\Serializer\Annotation\Type;

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
}