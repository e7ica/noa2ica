<?php

namespace App\Controller\More\Api;

use App\Controller\More\Api\More\RequestTracker;
use App\Service\More\RetrieveResponseService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ResponseController extends AbstractController
{
    use RequestTracker;

    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly RetrieveResponseService $retrieveFormService
    )
    {
        $this->logger->info('ResponseController was created');
    }


    #[Route('/Api/inspection/{inspection_id}/responses/last/retrieve', name: 'app_responses_retrieve_last', methods: ['GET'])]
    public function retrieveLastResponse(int $inspection_id): Response
    {
        $requestId = $this->makeRequestId();
        $this->logger->info("[RESPONSES API - RETRIEVE LAST RESPONSE | GET #$requestId] Retrieve last response for inspection $inspection_id");

        $lastResponse = $this->retrieveFormService->retrieveLastResponse($inspection_id);

        return $this->_json([
            "data" => [
                "response" => $lastResponse->toArray(),
            ],
            'status' => 'success',
        ], 200);
    }

    private function _json(mixed $data, int $status = 200, array $headers = [], array $context = []): JsonResponse
    {
        if ($this->container->has('serializer')) {
            $json = $this->container->get('serializer')->serialize($data, 'json', array_merge([
                'json_encode_options' => JSON_UNESCAPED_SLASHES
            ], $context));

            return new JsonResponse($json, $status, $headers, true);
        }

        return new JsonResponse($data, $status, $headers);
    }

}
