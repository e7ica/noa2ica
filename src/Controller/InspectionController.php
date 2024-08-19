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

        # 'type' => 'yes_no',
        $questions = [
            [
                'id' => 1,
                'ref' => 'carnet_manipulacion_alimentos',
                'type' => 'multiple_choice',
                'status' => 'Aprobado',
                'label' => '¿Exhibe el personal carnet de manipulación de alimentos vigente?',
                'can_attach' => true,
                'can_select_others' => false,
                'can_emplacement' => true,
                'group' => 'Higiene',
                'options' => [
                    ['label' => 'Sí', 'value' => 'true', 'other' => false, 'compliance' => true],
                    ['label' => 'No', 'value' => 'false', 'other' => false, 'compliance' => false],
                ],
                'summon' => [
                    'can_emplacement' => true,
                    'emplacement' => [
                        'days' => '15',
                        'actions' => [
                            'Infraccion',
                            'Amonestación',
                        ],
                    ],
                    'sanction' => [
                        'actions' => [
                            'Clausura',
                            'Multa',
                            'Suspensión de actividades',
                        ],
                    ],
                ],
                'comment' => '',
                'other_value' => '', 'other_compliance' => true,
            ],
            [
                'id' => 2,
                'ref' => 'dispocitivos_anti_inceptos',
                'type' => 'multiple_choice',
                'status' => 'Rechazado',
                'label' => '¿Qué dispositivos anti-insectos están presentes?',
                'can_attach' => false,
                'can_select_others' => true,
                'can_emplacement' => true,
                'group' => 'Higiene Ambiental',
                'options' => [
                    ['label' => 'Tela mosquitera', 'value' => 'tela_mosquitera', 'other' => false, 'compliance' => true],
                    ['label' => 'Trampa para insectos', 'value' => 'trampa_insectos', 'other' => false,  'compliance' => true],
                    ['label' => 'Repelente eléctrico', 'value' => 'repelente_electrico', 'other' => false, 'compliance' => false ],
                    ['label' => 'Otros', 'value' => 'otros', 'other' => true, 'compliance' => true],
                ],
                'summon' => [
                    'can_emplacement' => false,
                    'emplacement' => [
                        'days' => '15',
                        'actions' => [
                            'Infraccion',
                            'Amonestación',
                        ],
                    ],
                    'sanction' => [
                        'actions' => [
                            'Clausura',
                            'Multa',
                            'Suspensión de actividades',
                        ],
                    ],
                ],
                'comment' => '',
                'other_value' => '', 'other_compliance' => true,
            ],
            [
                'id' => 3,
                'ref' => 'dispocitivos_incendios',
                'type' => 'multiple_choice',
                'status' => 'pendiente',
                'label' => '¿Qué dispositivos contra incendios están presentes?',
                'can_attach' => false,
                'can_select_others' => false,
                'can_emplacement' => true,
                'group' => 'Seguridad y Salud',
                'options' => [
                    ['label' => 'Extintor', 'value' => 'extintor', 'other' => false, 'compliance' => true],
                    ['label' => 'Manguera', 'value' => 'manguera', 'other' => false, 'compliance' => true],
                    ['label' => 'Alarma de incendios', 'value' => 'alarma_incendios', 'other' => false, 'compliance' => false],
                    ['label' => 'Otros', 'value' => 'otros', 'other' => true, 'compliance' => true],
                ],
                'summon' => [
                    'can_emplacement' => true,
                    'emplacement' => [
                        'days' => '15',
                        'actions' => [
                            'Infraccion',
                            'Amonestación',
                        ],
                    ],
                    'sanction' => [
                        'actions' => [
                            'Clausura',
                            'Multa',
                            'Suspensión de actividades',
                        ],
                    ],
                ],
                'comment' => '',
                'other_value' => '', 'other_compliance' => true,
            ],
        ];

        $inspection = [
            'id' => '1',
            'title' => 'Inspección de Higiene',
            'type' => 'inspeccion',
            'business' => 'Carniceria El Lobo',
            'address' => 'Avenida Secundaria #456',
            'time' => '09:00 - 11:30',
            'number' => '#00000015',
            'initials' => 'JP',
            'status' => 'Aprobado',
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

        return $this->render('inspection/v1/step.html.twig', [
            'inspection_id' => $inspection_id,
            'inspection' => $inspection,
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
        $formResponse = $session->get('form_response');
        $session->remove('form_response');

        $questions = [
            [
                'ref' => 'carnet_manipulacion_alimentos',
                'title' => 'Carnet de Manipulación de Alimentos'
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

        return $this->render('inspection/v1/complete.html.twig', [
            'inspection_id' => $inspection_id,
            'inspection' => $inspeccion,
            'questions' => $questions,
            'formResponse' => $formResponse
        ]);
    }

}
