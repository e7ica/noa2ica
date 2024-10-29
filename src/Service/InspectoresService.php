<?php

namespace App\Service;

use App\DTO\Inspector;
use App\DTO\DetailView\Address;


class InspectoresService implements InspectoresServiceInterface
{

    private array $inspectors = [];

    public function __construct()
    {
        $this->loadSampleData();
    }

    private function loadSampleData()
    {
        $this->inspectors = [
            1 => new Inspector(
                1,
                'Inspector 1',
                '12345678A',
                new Address('Calle Inspector 1', '12345', 'Inspectorville', 'Inspectorland'),
                '123456789'
            ),
            2 => new Inspector(
                2,
                'Inspector 2',
                '12345678B',
                new Address('Calle Inspector 2', '12345', 'Inspectorville', 'Inspectorland'),
                '123456789'
            ),
            3 => new Inspector(
                3,
                'Inspector 3',
                '12345678C',
                new Address('Calle Inspector 3', '12345', 'Inspectorville', 'Inspectorland'),
                '123456789'
            ),
        ];
    }

    public function getInspectorById(int $id): ?Inspector
    {
        return $this->inspectors[$id] ?? null;
    }

    public function getInspectors(): array
    {
        return $this->inspectors;
    }
}