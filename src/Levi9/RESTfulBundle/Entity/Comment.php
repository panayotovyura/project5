<?php

namespace Levi9\RESTfulBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table()
 * @ORM\Entity
 * @SuppressWarnings(PHPMD.ShortVariable)
 */
class Comment
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="repoId", type="integer")
     */
    private $repoId;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string")
     */
    private $comment;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set repoId
     *
     * @param $repoId
     * @return Comment
     */
    public function setRepoId($repoId)
    {
        $this->repoId = $repoId;

        return $this;
    }

    /**
     * Get repoId
     *
     * @return int
     */
    public function getRepoId()
    {
        return $this->repoId;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return Comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }
}
