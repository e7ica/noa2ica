<?php

namespace App\Controller\More\Api\More;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RetrieveAttachmentController extends AbstractController
{
    public function __construct(
        private readonly LoggerInterface $logger
    )
    {
    }


    #[Route('/retrieve/attachments', name: 'app_retrieve_attachment')]
    public function index(): Response
    {
        return $this->render('retrieve_attachment/index.html.twig', [
            'controller_name' => 'RetrieveAttachmentController',
        ]);
    }
}
