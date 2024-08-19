<?php

namespace App\Controller\More\Api\More;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RetrieveAnswerController extends AbstractController
{
    public function __construct(
        private readonly LoggerInterface $logger
    )
    {
    }

    #[Route('/retrieve/answer', name: 'app_retrieve_answer')]
    public function index(): Response
    {
        return $this->render('retrieve_answer/index.html.twig', [
            'controller_name' => 'RetrieveAnswerController',
        ]);
    }
}
