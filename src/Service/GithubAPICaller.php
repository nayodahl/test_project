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
     * retrieve commits of a user on a given repo, between 2 dates, from Github API.
     * doc : https://docs.github.com/en/rest/reference/repos#commits
     * we decode the response and return the result as an array
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
