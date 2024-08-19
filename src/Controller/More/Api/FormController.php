<?php

namespace App\Controller\More\Api;

use App\Controller\More\Api\More\RequestTracker;
use App\Service\More\RetrieveFormService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

# uuid


class FormController extends AbstractController
{
    use RequestTracker;

    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly RetrieveFormService $retrieveFormService
    )
    { }


    #[Route('/Api/inspections/{inspectionId}/form/retrieve', name: 'app_forms_retrieve', methods: ['GET'])]
    public function retrieveForm(string $inspectionId): Response
    {
        $requestId = $this->makeRequestId();
        $this->logger->info("[FORMS API - RETRIEVE FORM | GET #$requestId] Retrieve form for inspection $inspectionId");

        $form = $this->retrieveFormService->retrieveForm($inspectionId);

        return $this->json([
            "data" => [
                "form" => $form->toArray(),
            ],
            'status' => 'success',
        ], 200);
    }

}
