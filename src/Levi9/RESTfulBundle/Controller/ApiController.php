<?php

namespace Levi9\RESTfulBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Levi9\RESTfulBundle\Service\GithubApi;
use Levi9\RESTfulBundle\Service\Comment;

class ApiController extends FOSRestController
{
    /**
     * Get repositories list from GitHub api action.
     *
     * @param Request $request
     * @return Response
     */
    public function getReposAction(Request $request)
    {
        $view = $this->view(
            $this->get('levi9_restful.github_api')->getReposList(
                $request->get('page', GithubApi::DEFAULT_PAGE),
                $request->get('per_page', GithubApi::DEFAULT_PER_PAGE)
            ),
            Response::HTTP_OK
        );

        return $this->handleView($view);
    }

    /**
     * Get comments for repository action.
     *
     * @param Request $request
     * @param $name
     * @return Response
     */
    public function getReposCommentsAction(Request $request, $name)
    {
        $repo = $this->get('levi9_restful.github_api')->getRepo($name);
        if (!$repo) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        $view = $this->view(
            $this->get('levi9_restful.comment')->getComments(
                $repo->getId(),
                $request->get('page', Comment::DEFAULT_PAGE),
                $request->get('per_page', Comment::DEFAULT_PER_PAGE)
            ),
            Response::HTTP_OK
        );

        return $this->handleView($view);
    }

    /**
     * Create new comment in repository action.
     *
     * @param Request $request
     * @param $name
     * @return Response
     */
    public function postReposCommentsAction(Request $request, $name)
    {
        $repo = $this->get('levi9_restful.github_api')->getRepo($name);
        $comment = $request->get('comment');

        if (!$repo || !$comment) {
            return new Response('', Response::HTTP_BAD_REQUEST);
        }

        $this->get('levi9_restful.comment')->createComment(
            $repo->getId(),
            $comment
        );

        $view = $this->view(
            null,
            Response::HTTP_CREATED
        );

        return $this->handleView($view);
    }

    /**
     * Get comment by id action.
     *
     * @param $name
     * @param $id
     * @return Response
     *
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    public function getReposCommentAction($name, $id)
    {
        $repo = $this->get('levi9_restful.github_api')->getRepo($name);
        $comment = $this->get('levi9_restful.comment')->getComment($id, $repo->getId());

        if (!$comment) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        $view = $this->view(
            $comment,
            Response::HTTP_OK
        );

        return $this->handleView($view);
    }
}
