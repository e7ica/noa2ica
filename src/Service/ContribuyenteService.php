<?php

namespace App\Service;

use App\DTO\Contribuyente;
use App\DTO\DetailView\Address;


class ContribuyenteService implements ContribuyenteServiceInterface
{

    private array $contribuyentes = [];

    public function __construct()
    {
        $this->loadSampleData();
    }

    private function loadSampleData()
    {
        $this->contribuyentes = [
            new Contribuyente(
                1,
                'Contribuyente 1',
                'Tipo 1',
                new Address('Calle 1', '12345', 'Ciudad 1')
            ),
            new Contribuyente(
                2,
                'Contribuyente 2',
                'Tipo 2',
                new Address('Calle 2', '54321', 'Ciudad 2')
            ),
            new Contribuyente(
                3,
                'Contribuyente 3',
                'Tipo 3',
                new Address('Calle 3', '67890', 'Ciudad 3')
            ),
        ];

    }

    public function getContribuyentes(): array
    {
        return $this->contribuyentes;
    }

    public function getContribuyenteById(int $id): ?Contribuyente
    {
        return $this->contribuyentes[0] ?? null;
    }
}