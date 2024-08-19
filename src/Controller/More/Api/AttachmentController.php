<?php

namespace App\Controller\More\Api;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AttachmentController extends AbstractController
{

    public function __construct(
        private LoggerInterface $logger
    )
    {
    }

    // attach file to answer multipart/form-data
    #[Route('/Api/attachments', name: 'app_attachment', methods: ['POST'])]
    public function attach_file(): Response
    {
        $this->logger->info('File attached');

        return $this->json([
            'status' => 'success',
        ], 200);
    }
}
