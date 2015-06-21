<?php

namespace Levi9\RESTfulBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Levi9\RESTfulBundle\Service\GithubApi;

class ApiVersion1Controller extends FOSRestController
{
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
}
