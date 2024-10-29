<?php

namespace App\Controller\Inspectores;

use App\DTO\Inspector;
use App\Service\InspectoresServiceInterface;
use App\Service\HistoryServiceInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Routing\Annotation\Route;

class HistorialController extends AbstractController
{

    private HistoryServiceInterface $historyService;
    private InspectoresServiceInterface $inspectoresService;
    private LoggerInterface $logger;
#    private SluggerInterface $slugger;

    public function __construct(
        HistoryServiceInterface $historyService,
        InspectoresServiceInterface $inspectoresService,
        LoggerInterface $logger,
#        SluggerInterface $slugger
    )
    {
        $this->historyService = $historyService;
        $this->inspectoresService = $inspectoresService;
        $this->logger = $logger;
#        $this->slugger = $slugger;
    }

    #[Route('/inspectores/{inspectorId}/historial', name: 'inspectores_historial', requirements: [
        'inspectorId' => '\d+'
    ])]
    public function index(Request $request, int $inspectorId): Response
    {
        $inspector = $this->inspectoresService->getInspectorById($inspectorId);
        $history = $this->historyService->getHistoryByInspector($inspectorId);
        $this->logger->info('Historial de inspecciones para el inspector ' . $inspectorId);
        $this->logger->debug('Historial de inspecciones para el inspector ' . $inspectorId, $history);

        return $this->render('inspectores/[inspector_id]/historial/index.html.twig', [
            'inspector' => $inspector,
            'history_items' => $history,
        ]);
    }

}
