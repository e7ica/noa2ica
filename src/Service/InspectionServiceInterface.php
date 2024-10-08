<?php

namespace App\Service;

use App\DTO\FormView\InspectionForm;

interface InspectionServiceInterface
{
    public function getInspections(): array;
    public function getInspectionById(int $id): ?InspectionForm;
}