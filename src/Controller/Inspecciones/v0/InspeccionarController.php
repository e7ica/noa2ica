<?php
// src/Controller/InspeccionarController.php

namespace App\Controller\Inspecciones\v0;

use App\Service\InspectionServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class InspeccionarController extends AbstractController
{

    public function __construct(
        private readonly InspectionServiceInterface $inspectionService
    ) {}


    #[Route('/v0/inspection/{inspection_id}/form/step/{step}', name: 'inspection_form_step', requirements: [
        'inspection_id' => '\d+',
        'step' => '\d+'
    ])]
    public function formStep(Request $request, SessionInterface $session, int $inspection_id, int $step = 0): Response
    {

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
                'first' => true, 'last' => false,
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
                'first' => false, 'last' => false,
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
                'ref' => 'dispositivos_incendios',
                'type' => 'multiple_choice',
                'status' => 'pendiente',
                'label' => '¿Qué dispositivos contra incendios están presentes?',
                'can_attach' => false,
                'can_select_others' => false,
                'can_emplacement' => true,
                'first' => false, 'last' => true,
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
            'status' => 'Abierta',
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
                return $this->redirectToRoute('inspection_summary', [
                    'inspection_id' => $inspection_id
                ]);
            }
        }

        return $this->render('inspection/v1/control_form.html.twig', [
            'inspection_id' => $inspection_id,
            'inspection' => $inspection,
            'question' => $questions[$step],
            'step' => $step,
            'totalSteps' => $totalSteps,
            'formResponse' => $formResponse
        ]);
    }

    #[Route('/v0/inspection/{inspection_id}/form/complete', name: 'inspection_form_complete',requirements: [
        'inspection_id' => '\d+'
    ])]
    public function complete(SessionInterface $session, int $inspection_id): Response
    {
        $formResponse = $session->get('form_response');
        $session->remove('form_response');

        $inspeccion = [
            'id' => '1',
            'title' => 'Inspección de Higiene',
            'type' => 'inspeccion',
            'business' => 'Carniceria El Lobo',
            'address' => 'Avenida Secundaria #456',
            'time' => '09:00 - 11:30',
            'number' => '#00000015',
            'initials' => 'JP',
            'status' => 'abierta',
            'acta' => [
                'status' => 'pendiente',
                'link' => 'https://www.google.com',
            ],
            'inspector' => 'Juan Pérez',
            'date' => '2021-10-15',
            'observations' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit'
        ];

        $controles = [
            [
                'id' => 1,
                'ref' => 'carnet_manipulacion_alimentos',
                'status' => 'Aprobado',
                'label' => '¿Exhibe el personal carnet de manipulación de alimentos vigente?',
                'has_attachment' => true,
                'group' => 'Higiene Ambiental',
                'selected_option' => [
                    [
                        'label' => 'No',
                        'value' => 'false',
                        'compliance' => false
                    ]
                ],
                'comment' => 'Lorem ipsum dolor sit amett',
            ],
            [
                'id' => 2,
                'ref' => 'dispocitivos_anti_inceptos',
                'status' => 'Rechazado',
                'label' => '¿Qué dispositivos anti-insectos están presentes?',
                'has_attachment' => false,
                'group' => 'Higiene Ambiental',
                'selected_option' => [
                    [
                        'label' => 'Tela mosquitera',
                        'value' => 'tela_mosquitera',
                        'compliance' => true
                    ],
                    [
                        'label' => 'Trampa para insectos',
                        'value' => 'trampa_insectos',
                        'compliance' => true
                    ],
                    [
                        'label' => 'Otros',
                        'value' => 'otros',
                        'compliance' => true
                    ]
                ],
                'comment' => 'Lorem ipsum dolor sit amett',
            ],
            [
                'id' => 3,
                'ref' => 'dispositivos_incendios',
                'status' => 'pendiente',
                'label' => '¿Qué dispositivos contra incendios están presentes?',
                'has_attachment' => false,
                'group' => 'Seguridad y Incendios',
                'selected_option' => [
                    [
                        'label' => 'Extintor',
                        'value' => 'extintor',
                        'compliance' => true
                    ],
                    [
                        'label' => 'Manguera',
                        'value' => 'manguera',
                        'compliance' => true
                    ],
                    [
                        'label' => 'Otros',
                        'value' => 'otros',
                        'compliance' => true
                    ]
                ],
                'comment' => 'Lorem ipsum dolor sit amett',
                'other_value' => 'Lorem ipsum',
            ],
            [
                'id' => 4,
                'ref' => 'dispositivos_incendios',
                'status' => 'pendiente',
                'label' => '¿Qué dispositivos contra incendios están presentes?',
                'has_attachment' => false,
                'group' => 'Seguridad y Incendios',
                'selected_option' => [
                    [
                        'label' => 'Extintor',
                        'value' => 'extintor',
                        'compliance' => true
                    ],
                    [
                        'label' => 'Manguera',
                        'value' => 'manguera',
                        'compliance' => true
                    ],
                    [
                        'label' => 'Otros',
                        'value' => 'otros',
                        'compliance' => true
                    ]
                ],
                'comment' => 'Lorem ipsum dolor sit amett',
                'other_value' => 'Lorem ipsum',
            ],
            [
                'id' => 5,
                'ref' => 'dispositivos_incendios',
                'status' => 'pendiente',
                'label' => '¿Qué dispositivos contra incendios están presentes?',
                'has_attachment' => false,
                'group' => 'Seguridad y Incendios',
                'selected_option' => [
                    [
                        'label' => 'Extintor',
                        'value' => 'extintor',
                        'compliance' => true
                    ],
                    [
                        'label' => 'Manguera',
                        'value' => 'manguera',
                        'compliance' => true
                    ],
                    [
                        'label' => 'Otros',
                        'value' => 'otros',
                        'compliance' => true
                    ]
                ],
                'comment' => 'Lorem ipsum dolor sit amett',
                'other_value' => 'Lorem ipsum',
            ],
            [
                'id' => 6,
                'ref' => 'dispositivos_incendios',
                'status' => 'pendiente',
                'label' => '¿Qué dispositivos contra incendios están presentes?',
                'has_attachment' => false,
                'group' => 'Seguridad y Incendios',
                'selected_option' => [
                    [
                        'label' => 'Extintor',
                        'value' => 'extintor',
                        'compliance' => true
                    ],
                    [
                        'label' => 'Manguera',
                        'value' => 'manguera',
                        'compliance' => true
                    ]
                ],
                'comment' => 'Lorem ipsum dolor sit amett',
                'other_value' => null,
            ]
        ];

        $controlsByGroup = $this->orderByGroup($controles);

        return $this->render('inspection/v1/complete_page.html.twig', [
            'inspection_id' => $inspection_id,
            'inspection' => $inspeccion,
            'controls' => $controlsByGroup,
            'formResponse' => $formResponse
        ]);
    }


    #[Route('/inspection/{inspection_id}/form/inspection_summary', name: 'inspection_summary',requirements: [
        'inspection_id' => '\d+'
    ])]
    public function summary(SessionInterface $session, int $inspection_id): Response
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
            'status' => 'emplazada',
            'closed' => true,
            'acta' => [
                'status' => 'pendiente',
                'link' => 'https://www.google.com',
            ],
            'inspector' => 'Juan Pérez',
            'date' => '2021-10-15',
            'observations' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit'
        ];

        return $this->render('inspection/v1/inspection_summary.html.twig', [
            'inspection_id' => $inspection_id,
            'inspection' => $inspeccion,
            'questions' => $questions,
            'formResponse' => $formResponse
        ]);
    }

    private function orderByGroup(array $controles)
    {
        $controlsByGroup = [];
        foreach ($controles as $control) {
            $group = $control['group'];
            if (!isset($controlsByGroup[$group])) {
                $controlsByGroup[$group] = [];
            }
            $controlsByGroup[$group][] = $control;
        }

        $resultado = [];

        foreach ($controlsByGroup as $grupo => $groupControls) {
            $resultado[] = [
                "group" => $grupo,
                "controls" => $groupControls
            ];
        }
        return $resultado;
    }


}
