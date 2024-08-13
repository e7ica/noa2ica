<?php

namespace App\Controller\Api\More;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RetrieveResponseController extends AbstractController
{

    public function __construct(
        private readonly LoggerInterface $logger
    )
    {
    }

    #[Route('/api/retrieve/response', name: 'app_retrieve_response')]
    public function index(): Response
    {
        return $this->render('retrieve_response/index.html.twig', [
            'controller_name' => 'RetrieveResponseController',
        ]);
    }
}
