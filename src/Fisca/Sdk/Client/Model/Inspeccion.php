<?php

namespace App\Fisca\Sdk\Client\Model;

use App\Fisca\Sdk\Client\Model\Key\IdInspeccion;
use App\Fisca\Sdk\Client\Model\Key\IdProtocolo;
use App\Fisca\Sdk\Client\Model\State\EstadoInspeccion;

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