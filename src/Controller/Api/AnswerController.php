<?php

namespace App\Controller\Api;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AnswerController extends AbstractController
{
    public function __construct(
        private LoggerInterface $logger
    )
    {
    }

    public function anwser(): Response
    {
        return $this->json([
            'status' => 'success',
        ], 200);
    }

}
