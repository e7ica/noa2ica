<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{

    #[Route('/', name: 'main')]
    public function index(): Response
    {
        # return new Response("Hola fisca!");
        return $this->redirect('fisca/home/inspector');
    }

}