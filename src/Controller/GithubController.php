<?php

namespace App\Controller;

use App\Service\CollectionCreator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class GithubController extends AbstractController
{
    /**
     * @Route("/{user}/{repository}/{since}/{until}", name="github", requirements={ 
     * "since"="^[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}:[0-9]{2}$", 
     * "until"="^[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}:[0-9]{2}$" 
     * })
     * date parameters format exemeple : 2021-04-02T04:57:33
     */
    public function getCommitsOfUser(
        string $user,
        string $repository,
        string $since = null,
        string $until = null,
        CollectionCreator $collectionCreator,
        SerializerInterface $serializer
    ): Response {
        try {
            $data = $collectionCreator->getCommitsCollection(
                $user,
                $repository,
                $since,
                $until,
            );
    
            $json = $serializer->serialize($data, 'json');
            $response = new Response($json, 200, ['Content-Type' => 'application/json']);
    
            return $response;
        } catch (\Exception $e) {
            return $this->json(['message' => $e->getMessage()], 400);
        }
    }
}
