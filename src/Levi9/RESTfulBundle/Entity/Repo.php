<?php

namespace Levi9\RESTfulBundle\Entity;

use JMS\Serializer\Annotation\Type;

/**
 * Class Repo
 * @package Levi9\RESTfulBundle\Entity
 * @SuppressWarnings(PHPMD.ShortVariable)
 * @SuppressWarnings(PHPMD.UnusedPrivateField)
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
}
