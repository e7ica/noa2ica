<?php

namespace App\Service;

use App\DTO\DetailView\Address;
use App\DTO\HistoryView\InspectionItem;
use App\Service\HistoryServiceInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Filesystem\Filesystem;

class MockHistoryService implements HistoryServiceInterface
{

    private LoggerInterface $logger;
    private array $historyList = [];

    public function __construct(
        LoggerInterface $logger
    )
    {
        $this->logger = $logger;
        $this->loadHistory();
    }

    private function loadHistory(): void
    {
        $filesystem = new Filesystem();
        $historyListFiles = [
            __DIR__ . '/../data/history/list/1.json',
            __DIR__ . '/../data/history/list/2.json',
            __DIR__ . '/../data/history/list/3.json',
        ];

        foreach ($historyListFiles as $file) {
            $items = [];

            if ($filesystem->exists($file)) {
                $data = json_decode(file_get_contents($file), true);

                foreach ($data as $dataItem) {

                    // Hidratar objeto InspectionForm
                    $inspection = new InspectionItem(
                        $dataItem['id'],
                        $dataItem['title'],
                        $dataItem['type'],
                        $dataItem['business'],
                        $dataItem['status'],
                        new Address(
                            $dataItem['address']
                        ),
                        $dataItem['date'],
                        $dataItem['inspector'],
                        $dataItem['observations']
                    );

                    $items[] = $inspection;
                }

                $this->historyList[] = $items;
            }
        }
    }


    public function getHistoryByInspector($inspectorId): array
    {
        return $this->historyList[$inspectorId];
    }

    public function getHistoryByContribuyente($contribuyenteId): array
    {
        return $this->historyList[$contribuyenteId];
    }
}