<?php

namespace App\Sdk\Client\Api\Parsers;

use App\Fisca\Sdk\Client\Api\Parsers\IdProtocolo;
use App\Fisca\Sdk\Client\Api\Parsers\Interface;
use App\Sdk\Client\Model\Inspeccion;
use App\Sdk\Client\Model\Key\IdInspeccion;
use App\Sdk\Client\Model\State\EstadoInspeccion;

class InspeccionParser implements InspeccionParserInterface
{
    private ControlValorParserInterface $controlValorParser;

    public function __construct()
    {
        $this->controlValorParser = new ControlValorParser();
    }

    /**
     * @param $json_data
     * @return Interface
     */
    public function parse($json_data): Inspeccion
    {
        $inspeccion = new Inspeccion();
        $inspeccion->id = IdInspeccion::fromString($json_data['id']);
        $inspeccion->estado = EstadoInspeccion::fromString($json_data['tipo']);
        $inspeccion->protocolo = IdProtocolo::fromString($json_data['protocolo']);
        $inspeccion->setValores(
            array_map(
                function ($controlValor) {
                    return $this->controlValorParser->parse($controlValor);
                },
                $json_data['valores']
            )
        );
        return $inspeccion;
    }

}