<?php

namespace App\Controller\Controles;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ComenzarControlController extends AbstractController
{

    #[Route('/fisca/inspeccion/{inspeccion_id}/controles/start', name:'fisca_control_start')]
    public function index($inspeccion_id): Response
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

        $control = [
            'id' => '1',
            'title' => 'Control de Higiene',
            'type' => 'control',
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
            'fisca/control/start/index.html.twig', [
                'inspection' => $inspeccion,
                'control' => $control
            ]
        );
    }

    #[Route('/fisca/inspeccion/{inspeccion_id}/controles/{control_id}/start', name: 'fisca_controles_start_control')]
    public function indexByControl($inspeccion_id, $control_id): Response
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

        $control = [
            'id' => '1',
            'title' => 'Control de Higiene',
            'type' => 'control',
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
            'fisca/control/start/index.html.twig', [
                'inspection' => $inspeccion,
                'control' => $control
            ]
        );
    }

}