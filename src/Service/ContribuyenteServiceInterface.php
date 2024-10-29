<?php

namespace App\Service;
use App\DTO\Contribuyente;

interface ContribuyenteServiceInterface
{

    public function getContribuyentes(): array;
    public function getContribuyenteById(int $id): ?Contribuyente;

}