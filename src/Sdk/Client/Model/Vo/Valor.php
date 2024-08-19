<?php

namespace App\Sdk\Client\Model\Vo;

use App\Sdk\Client\Model\Type\TipoValor;

/**
 * Class Valor tine un valor segun el tipo de dato
 */
class Valor
{
    public TipoValor $tipo;
    public bool $isFilled;
    public array $arrayValue;
    public object $objectValue;

    public function __construct(
            TipoValor $tipo
    ) {
        $this->isFilled = false;
    }


}