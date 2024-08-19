<?php

namespace App\Sdk\Client\Model;

use App\Sdk\Client\Model\Key\IdInspeccion;
use App\Sdk\Client\Model\Key\IdProtocolo;
use App\Sdk\Client\Model\State\EstadoInspeccion;

class Inspeccion
{
    public function __construct(
        public IdInspeccion $id,
        public IdProtocolo $protocolo,
        public EstadoInspeccion $estado,
        public array $valores = []
    ) {
    }

}