<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GithubControllerTest extends WebTestCase
{
    public function testGetCommitsOfUser(): void
    {
        $client = static::createClient();
        $response = $client->request('GET', '/nayodahl/poketournament/2021-04-10T04:57:53/2021-04-30T14:57:53');

        $response = $client->getResponse();
        $content = json_decode($response->getContent(), true);

        $this->assertResponseIsSuccessful();
    }
}
