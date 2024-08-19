<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{

    #[Route('/', name: 'main')]
    public function main(): Response
    {
        # return new Response("Hola fisca!");
        return $this->redirect('fisca/home/inspector');
    }


    #[Route('/fisca/home/inspector', name: 'fisca_home_inspector')]
    public function index(): Response
    {
        // Lista de inspecciones mock
        $inspecciones = [
            [
                'id' => '1',
                'title' => 'Inspección de Higiene',
                'type' => 'inspeccion',
                'business' => 'Carniceria El Lobo',
                'address' => 'Avenida Secundaria #456',
                'time' => '09:00 - 11:30',
                'number' => '#00000015',
                'initials' => 'JP',
                'status' => 'Retrasada',
            ],
            [
                'id' => '2',
                'title' => 'Fiscalización de Seguridad',
                'type' => 'fiscalizacion',
                'business' => 'Panadería La Estrella',
                'address' => 'Calle Principal #123',
                'time' => '10:00 - 12:00',
                'number' => '#00000016',
                'initials' => 'JL',
                'status' => 'Pendiente',
            ],
        ];

        return $this->render(
            'fisca/home/index.html.twig', [
                'inspections' => $inspecciones,
                'numOfInspections' => count($inspecciones),
            ]
        );

    }

}