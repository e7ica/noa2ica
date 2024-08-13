<?php

namespace App\Controller\Inspecciones;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class InspeccionDetalleController extends AbstractController
{

    #[Route('/fisca/inspeccion/{id}/detalle', name: 'fisca_inspeccion_detalle')]
    public function index($id): Response
    {
        // Inspección mock
        $inspeccion = [
            'id' => '1',
            'title' => 'Inspección de Higiene',
            'type' => 'inspeccion',
            'business' => 'Carniceria El Lobo',
            'address' => 'Avenida Secundaria #456',
            'time' => '09:00 - 11:30',
            'number' => '#00000015',
            'initials' => 'JP',
            'status' => 'Retrasada',
            'inspector' => 'Juan Pérez',
            'date' => '2021-10-15',
            'observations' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit'
        ];

        return $this->render(
            'fisca/inspeccion/detalle/index.html.twig', [
                'inspection' => $inspeccion,
            ]
        );
    }

}