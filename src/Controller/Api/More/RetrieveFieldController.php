<?php

namespace App\Controller\Api\More;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RetrieveFieldController extends AbstractController
{

    public function __construct(
        private readonly LoggerInterface $logger
    )
    {
    }

    #[Route('/retrieve/field', name: 'app_retrieve_field')]
    public function index(): Response
    {
        return $this->render('retrieve_field/index.html.twig', [
            'controller_name' => 'RetrieveFieldController',
        ]);
    }
}
