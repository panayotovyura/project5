<?php

namespace Levi9\RESTfulBundle\Service;

use GuzzleHttp\Client;
use JMS\Serializer\Serializer;

class GithubApi
{
    const GET_REPOS_LIST_METHOD = '/users/panayotovyura/repos';
    const JSON_TYPE = 'json';
    const REPO_ENTITY = 'Levi9\RESTfulBundle\Entity\Repo';

    const DEFAULT_PAGE = 1;
    const DEFAULT_PER_PAGE = 3;

    /**
     * @var Client
     */
    private $client;

    /**
     * @var Serializer
     */
    private $serializer;

    public function __construct(Client $client, Serializer $serializer)
    {
        $this->client = $client;
        $this->serializer = $serializer;
    }

    public function getReposList($page = self::DEFAULT_PAGE, $per_page = self::DEFAULT_PER_PAGE)
    {
        $response = $this->client->get(self::GET_REPOS_LIST_METHOD);

        return array_slice(
            $this->serializer->deserialize(
                $response->getBody()->getContents(),
                'array<'.self::REPO_ENTITY.'>',
                self::JSON_TYPE
            ),
            --$page*$per_page,
            $per_page
        );
    }
}