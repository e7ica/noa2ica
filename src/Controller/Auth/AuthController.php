<?php

namespace App\Controller\Auth;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController
{

    #[Route('/auth/login', name: 'auth_login')]
    public function login(): Response
    {
        return $this->render('auth/login.html.twig', [
            'error' => null,
            'last_username' => null,
        ]);
    }

}