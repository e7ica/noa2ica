<?php

namespace App\Controller\Contribuyentes;

use App\DTO\Contribuyente;
use App\Service\ContribuyenteServiceInterface;
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
    private ContribuyenteServiceInterface $contribuyenteService;
    private LoggerInterface $logger;
#    private SluggerInterface $slugger;

    public function __construct(
        HistoryServiceInterface $historyService,
        ContribuyenteServiceInterface $contribuyenteService,
        LoggerInterface $logger,
#        SluggerInterface $slugger
    )
    {
        $this->historyService = $historyService;
        $this->contribuyenteService = $contribuyenteService;
        $this->logger = $logger;
#        $this->slugger = $slugger;
    }

    #[Route('/contribuyentes/{contribuyenteId}/historial', name: 'contribuyente_historial', requirements: [
        'contribuyenteId' => '\d+'
    ])]
    public function index(Request $request, int $contribuyenteId): Response
    {
        $contribuyente = $this->contribuyenteService->getContribuyenteById($contribuyenteId);
        $history = $this->historyService->getHistoryByContribuyente($contribuyenteId);
        $this->logger->info('Historial de inspecciones para el contribuyente ' . $contribuyenteId);
        $this->logger->debug('Historial de inspecciones para el contribuyente ' . $contribuyenteId, $history);

        return $this->render('contribuyentes/[contribuyente_id]/historial/index.html.twig', [
            'contribuyente' => $contribuyente,
            'history_items' => $history,
        ]);
    }

}
