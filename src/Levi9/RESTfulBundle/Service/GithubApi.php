<?php

namespace Levi9\RESTfulBundle\Service;

use GuzzleHttp\Client;
use JMS\Serializer\Serializer;
use Levi9\RESTfulBundle\Entity\Repo;

class GithubApi
{
    const GET_REPOS_LIST_METHOD = '/users/panayotovyura/repos';
    const GET_REPO_METHOD = '/repos/panayotovyura/%s';
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

    /**
     * Get repositories list from GitHub api.
     *
     * @param int $page
     * @param int $perPage
     * @return Repo[]
     */
    public function getReposList(
        $page = self::DEFAULT_PAGE,
        $perPage = self::DEFAULT_PER_PAGE
    ) {
        $repos = [];

        try {
            $response = $this->client->get(self::GET_REPOS_LIST_METHOD);

            $repos = array_slice(
                $this->serializer->deserialize(
                    $response->getBody()->getContents(),
                    'array<'.self::REPO_ENTITY.'>',
                    self::JSON_TYPE
                ),
                --$page*$perPage,
                $perPage
            );

        } catch (\Exception $exception) {
            // log error
        }

        return $repos;
    }

    /**
     * Get repository from GitHub by name.
     *
     * @param $name
     * @return Repo|null
     */
    public function getRepo($name)
    {
        $repo = null;

        try {
            $response = $this->client->get($this->getRepoUri($name));

            $repo = $this->serializer->deserialize(
                $response->getBody()->getContents(),
                self::REPO_ENTITY,
                self::JSON_TYPE
            );
        } catch (\Exception $exception) {
            // log error
        }

        return $repo;
    }

    protected function getRepoUri($name)
    {
        return sprintf(self::GET_REPO_METHOD, $name);
    }
}
