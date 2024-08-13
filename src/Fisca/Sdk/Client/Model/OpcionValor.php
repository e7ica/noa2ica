<?php

namespace App\Fisca\Sdk\Client\Model;

use App\Fisca\Sdk\Client\Model\Key\CodigoOpcion;
use App\Fisca\Sdk\Client\Model\Type\TipoConstancia;
use App\Fisca\Sdk\Client\Model\Type\TipoCumplimiento;

class OpcionValor
{
    public function __construct(
        public CodigoOpcion $codigo,
        public string $texto,
        public TipoCumplimiento $cumplimiento,
        public TipoConstancia $constancia
    ) {}

}