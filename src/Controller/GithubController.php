<?php

namespace App\Controller;

use App\Service\GithubCaller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GithubController extends AbstractController
{
    /**
     * @Route("/{user}/{repository}/{since}/{until}", name="github")
     */
    public function parseCommitsOfUser(string $user, string $repository, string $since = null, string $until = null, GithubCaller $githubCaller): Response
    {      
        $data = $githubCaller->getCommitsFromApi(
            $user, 
            $repository, 
            $since, 
            $until,
        );
        
        return $this->json($data, 200);
    }
}
