<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class GithubAPICaller
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }
    
    /**
     * retrieve commits from Github API.
     * @return array<array>
     */
    public function getCommitsFromApi(string $user, string $repository, string $since, string $until): array
    {
        $response = $this->client->request(
            'GET',
            'https://api.github.com/repos/'.$user.'/'.$repository.'/commits?since='.$since.'&until='.$until
        );
        $content = $response->getContent();
        
        return json_decode($content, true);
    }
}
