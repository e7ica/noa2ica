<?php

namespace App\Fisca\Sdk\Client\Api\Parsers;

use App\Fisca\Sdk\Client\Model\ControlValor;

class ControlValorParser implements ControlValorParserInterface
{
    public function __construct()
    {
    }


    public function parse($json_data): ControlValor
    {
        $controlValor = new ControlValor();
        $controlValor->setId($data['id']);
        $controlValor->setValor($data['valor']);
        $controlValor->setOpcion($data['opcion']);
        $controlValor->setInspeccion($data['inspeccion']);
        $controlValor->setValor($data['valor']);
        return $controlValor;
    }

}