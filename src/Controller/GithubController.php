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
     * @Route("/{user}/{repository}/{since}/{until}", name="github")
     */
    public function getCommitsOfUser(
        string $user,
        string $repository,
        string $since = null,
        string $until = null,
        CollectionCreator $collectionCreator,
        SerializerInterface $serializer
    ): Response {
        $data = $collectionCreator->getCommitsCollection(
            $user,
            $repository,
            $since,
            $until,
        );

        $json = $serializer->serialize($data, 'json');
        $response = new Response($json, 200, ['Content-Type' => 'application/json']);

        return $response;
    }
}
