<?php

namespace App\Service;

interface HistoryServiceInterface
{

    public function getHistoryByInspector($inspectorId): array;

    public function getHistoryByContribuyente($contribuyenteId): array;

}