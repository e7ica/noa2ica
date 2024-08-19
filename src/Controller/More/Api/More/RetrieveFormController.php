<?php

namespace App\Controller\More\Api\More;

use App\Service\More\RetrieveFormService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RetrieveFormController extends AbstractController
{

    public function __construct(
        private readonly LoggerInterface $logger,
        private RetrieveFormService $retrieveFormService
    )
    {
    }

    #[Route('/retrieve/form', name: 'app_retrieve_form', methods: ['GET'])]
    public function index(): Response
    {

        return $this->json([
            'status' => 'success',
        ], 200);
    }
}
