<?php

namespace App\Service;

use App\DTO\Inspection;

interface InspectionServiceInterface
{
    public function getInspections(): array;
    public function getInspectionById(int $id): ?Inspection;
}