<?php
// src/Controller/InspectionController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class InspectionController extends AbstractController
{
    #[Route('/inspection/{inspection_id}/form/step/{step}', name: 'inspection_form_step', requirements: [
        'inspection_id' => '\d+',
        'step' => '\d+'
    ])]
    public function formStep(Request $request, SessionInterface $session, int $inspection_id, int $step = 0): Response
    {
        // var_dump($inspection_id);
        // exit();
        $questions = [
            [
                'id' => 1,
                'ref' => 'carnet_manipulacion_alimentos',
                'type' => 'yes_no',
                'label' => '¿Exhibe el personal carnet de manipulación de alimentos vigente?',
                'options' => [
                    ['label' => 'Sí', 'value' => 'true'],
                    ['label' => 'No', 'value' => 'false'],
                ],
            ],
            [
                'id' => 2,
                'ref' => 'dispocitivos_anti_inceptos',
                'type' => 'multiple_choice',
                'label' => '¿Qué dispositivos anti-insectos están presentes?',
                'options' => [
                    ['label' => 'Tela mosquitera', 'value' => 'tela_mosquitera'],
                    ['label' => 'Trampa para insectos', 'value' => 'trampa_insectos'],
                    ['label' => 'Repelente eléctrico', 'value' => 'repelente_electrico'],
                ],
            ],
            [
                'id' => 3,
                'ref' => 'dispocitivos_incendios',
                'type' => 'multiple_choice',
                'label' => '¿Qué dispositivos contra incendios están presentes?',
                'options' => [
                    ['label' => 'Extintor', 'value' => 'extintor'],
                    ['label' => 'Manguera', 'value' => 'manguera'],
                    ['label' => 'Alarma de incendios', 'value' => 'alarma_incendios'],
                ],
            ],
        ];

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

        $totalSteps = count($questions);
        $formResponse = $session->get('form_response', []);

        if ($request->isMethod('POST')) {
            $formResponse[$step] = $request->request->all();
            $session->set('form_response', $formResponse);

            $nextStep = $step + 1;
            if ($nextStep < $totalSteps) {
                return $this->redirectToRoute('inspection_form_step', [
                    'inspection_id' => $inspection_id,
                    'step' => $nextStep
                ]);
            } else {
                return $this->redirectToRoute('inspection_form_complete', [
                    'inspection_id' => $inspection_id
                ]);
            }
        }

        return $this->render('inspection/step.html.twig', [
            'inspection_id' => $inspection_id,
            'inspection' => $inspeccion,
            'question' => $questions[$step],
            'step' => $step,
            'totalSteps' => $totalSteps,
            'formResponse' => $formResponse
        ]);
    }

    #[Route('/inspection/{inspection_id}/form/complete', name: 'inspection_form_complete',requirements: [
        'inspection_id' => '\d+'
    ])]
    public function complete(SessionInterface $session, int $inspection_id): Response
    {
        // var_dump($inspection_id);
        // exit();
        $formResponse = $session->get('form_response');
        $session->remove('form_response');

        // Aquí se procesarían las respuestas, por ejemplo, guardarlas en la base de datos

        // Pasar las preguntas y respuestas a la vista
        $questions = [
            [
                'ref' => 'carnet_manipulacion_alimentos',
                'title' => 'Carnet de Manipulación de Alimentos'
            ],
            // Añadir aquí las otras preguntas que correspondan
        ];


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

        return $this->render('inspection/complete.html.twig', [
            'inspection_id' => $inspection_id,
            'inspection' => $inspeccion,
            'questions' => $questions,
            'formResponse' => $formResponse
        ]);
    }

}
