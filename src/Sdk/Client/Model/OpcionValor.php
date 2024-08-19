<?php

namespace App\Sdk\Client\Model;

use App\Sdk\Client\Model\Key\CodigoOpcion;
use App\Sdk\Client\Model\Type\TipoConstancia;
use App\Sdk\Client\Model\Type\TipoCumplimiento;

class OpcionValor
{
    public function __construct(
        public CodigoOpcion $codigo,
        public string $texto,
        public TipoCumplimiento $cumplimiento,
        public TipoConstancia $constancia
    ) {}

}