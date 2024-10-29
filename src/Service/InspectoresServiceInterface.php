<?php

namespace App\Service;
use App\DTO\Inspector;

interface InspectoresServiceInterface
{

    public function getInspectorById(int $id): ?Inspector;

    public function getInspectors(): array;

}