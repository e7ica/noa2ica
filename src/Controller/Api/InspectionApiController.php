<?php

namespace App\Controller\Api;

use DateTime;
use DateInterval;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class InspectionApiController extends AbstractController
{
    public function __construct(
        private LoggerInterface $logger
    )
    {
    }


    #[Route('/api/inspections', name: 'api_inspections', methods: ['GET'])]
    public function getInspections(Request $request): JsonResponse
    {

        // Obtener parámetros de la request
        $page = $request->query->getInt('page', 1);
        $period = $request->query->get('period', 'week');
        $status = $request->query->get('status', 'all');
        $search = $request->query->get('search');
        $this->logger->info('Buscando inspecciones', [
            'page' => $page,
            'period' => $period,
            'status' => $status,
            'search' => $search
        ]);

        // Mock de datos con más ejemplos y fechas variadas
        $mockInspections = [
            [
                'id' => '00001',
                'date' => '2024-10-26', // Esta semana
                'status' => 'summoned',
                'category' => 'Higiene y Sanidad',
                'business_name' => 'Carnicería El Lobo',
                'comments' => 'Se encontraron algunas irregularidades menores en la limpieza de equipos.'
            ],
            [
                'id' => '00002',
                'date' => '2024-10-24', // Este mes
                'status' => 'approved',
                'category' => 'Seguridad Alimentaria',
                'business_name' => 'Restaurante La Buena Mesa',
                'comments' => 'Cumple con todos los estándares de seguridad alimentaria.'
            ],
            [
                'id' => '00003',
                'date' => '2024-10-05', // Hace más de 2 meses
                'status' => 'rejected',
                'category' => 'Cumplimiento Normativo',
                'business_name' => 'Supermercado El Ahorro',
                'comments' => 'Se encontraron graves incumplimientos de normativas de almacenamiento.'
            ],
            [
                'id' => '00004',
                'date' => '2024-06-10', // Hace más de 6 meses
                'status' => 'summoned',
                'category' => 'Higiene y Sanidad',
                'business_name' => 'Panadería La Estrella',
                'comments' => 'Se encontraron problemas de higiene en la cocina.'
            ],
            [
                'id' => '00005',
                'date' => '2024-03-15', // Hace más de 6 meses
                'status' => 'approved',
                'category' => 'Seguridad Alimentaria',
                'business_name' => 'Restaurante La Buena Mesa',
                'comments' => 'Cumple con todos los estándares de seguridad alimentaria.'
            ],
            [
                'id' => '00006',
                'date' => '2023-10-05', // Hace más de 6 meses
                'status' => 'rejected',
                'category' => 'Cumplimiento Normativo',
                'business_name' => 'Supermercado El Ahorro',
                'comments' => 'Se encontraron graves incumplimientos de normativas de almacenamiento.'
            ],
            [
                'id' => '00007',
                'date' => '2023-09-25', // Hace más de 6 meses
                'status' => 'summoned',
                'category' => 'Higiene y Sanidad',
                'business_name' => 'Panadería La Estrella',
                'comments' => 'Se encontraron problemas de higiene en la cocina.'
            ],
            [
                'id' => '00008',
                'date' => '2023-08-15', // Hace más de 6 meses
                'status' => 'approved',
                'category' => 'Seguridad Alimentaria',
                'business_name' => 'Restaurante La Buena Mesa',
                'comments' => 'Cumple con todos los estándares de seguridad alimentaria.'
            ]
        ];

        // Filtrar por período
        $today = new DateTime();
        $this->logger->info('Fecha actual', ['today' => $today->format('Y-m-d')]);

        $mockInspections = array_filter($mockInspections, function($inspection) use ($period, $today) {
            $inspectionDate = new DateTime($inspection['date']);

            $this->logger->info('Fecha de inspección', ['date' => $inspectionDate->format('Y-m-d')]);


            return match($period) {
                'week' => $this->isWithinLastWeek($inspectionDate, $today),
                'month' => $this->isWithinLastMonth($inspectionDate, $today),
                'sixMonths' => $this->isWithinLastSixMonths($inspectionDate, $today),
                default => true // 'all'
            };
        });

        // Filtrar por status si es necesario
        if ($status !== 'all') {
            $mockInspections = array_filter($mockInspections, fn($i) => $i['status'] === $status);
        }

        // Filtrar por búsqueda si existe
        if ($search && strlen($search) >= 3) {
            $mockInspections = array_filter($mockInspections, function($i) use ($search) {
                $this->logger->info('Buscando inspección', ['search' => $search, 'i' => $i]);
                return str_contains(strtolower($i['business_name']), strtolower($search));
            });
        }

        // Simular paginación
        $itemsPerPage = 5;
        $offset = ($page - 1) * $itemsPerPage;
        $paginatedInspections = array_slice($mockInspections, $offset, $itemsPerPage);

        $this->logger->info('Inspecciones encontradas', [
            'total' => count($mockInspections),
            'paginated' => count($paginatedInspections),
            'inspections' => $paginatedInspections
        ]);

        return new JsonResponse([
            'inspections' => array_values($paginatedInspections),
            'hasMore' => count($mockInspections) > ($offset + $itemsPerPage),
            'total' => count($mockInspections)
        ]);
    }

    private function isWithinLastWeek(DateTime $date, DateTime $today): bool
    {
        $lastWeek = clone $today;
        $lastWeek->sub(new DateInterval('P7D'));
        return $date >= $lastWeek && $date <= $today;
    }

    private function isWithinLastMonth(DateTime $date, DateTime $today): bool
    {
        $lastMonth = clone $today;
        $lastMonth->sub(new DateInterval('P1M'));
        return $date >= $lastMonth && $date <= $today;
    }

    private function isWithinLastSixMonths(DateTime $date, DateTime $today): bool
    {
        $sixMonthsAgo = clone $today;
        $sixMonthsAgo->sub(new DateInterval('P6M'));
        return $date >= $sixMonthsAgo && $date <= $today;
    }
}