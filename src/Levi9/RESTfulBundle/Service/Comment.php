<?php

namespace Levi9\RESTfulBundle\Service;

use Doctrine\ORM\EntityManager;
use Levi9\RESTfulBundle\Entity\Comment as CommentEntity;

class Comment
{
    const DEFAULT_PAGE = 1;
    const DEFAULT_PER_PAGE = 3;

    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Get list of comments by repository id.
     *
     * @param $repoId
     * @param int $page
     * @param int $perPage
     * @return CommentEntity[]
     */
    public function getComments(
        $repoId,
        $page = self::DEFAULT_PAGE,
        $perPage = self::DEFAULT_PER_PAGE
    ) {
        return array_slice(
            $this->entityManager
                ->getRepository('Levi9RESTfulBundle:Comment')
                ->findBy(['repoId' => $repoId]),
            --$page*$perPage,
            $perPage
        );
    }

    /**
     * Get comment by id and repository id.
     *
     * @param $id
     * @param $repoId
     * @return CommentEntity
     *
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    public function getComment($id, $repoId)
    {
        return $this->entityManager
            ->getRepository('Levi9RESTfulBundle:Comment')
            ->findOneBy(['id' => $id, 'repoId' => $repoId]);
    }

    /**
     * Create new comment.
     *
     * @param $repoId
     * @param $text
     */
    public function createComment($repoId, $text)
    {
        $comment = new CommentEntity();
        $comment->setRepoId($repoId)
            ->setComment($text);

        $this->saveComment($comment);
    }

    /**
     * Save comment in db.
     *
     * @param CommentEntity $comment
     */
    public function saveComment(CommentEntity $comment)
    {
        $this->entityManager->persist($comment);
        $this->entityManager->flush();
    }

    /**
     * Remove comment from db.
     *
     * @param CommentEntity $comment
     */
    public function removeComment(CommentEntity $comment)
    {
        $this->entityManager->remove($comment);
        $this->entityManager->flush();
    }
}
