<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class GithubCaller
{
    private HttpClientInterface $client;
    private DateInitializer $dateInitializer;

    public function __construct(HttpClientInterface $client, DateInitializer $dateInitializer)
    {
        $this->client = $client;
        $this->dateInitializer = $dateInitializer;
    }    
    
    /**
     * retrieve commits from Github API.
     */
    public function getCommitsFromApi(string $user, string $repository, string $since, string $until): array
    {        
        $since = $this->dateInitializer->initSinceDate($since);
        $until = $this->dateInitializer->initUntilDate($until);      
        
        $response = $this->client->request(
            'GET',
            'https://api.github.com/repos/'.$user.'/'.$repository.'/commits?since='.$since.'&until='.$until
        );
        $content = $response->getContent();
        $array=json_decode($content, true);

        return $array;
    }
}