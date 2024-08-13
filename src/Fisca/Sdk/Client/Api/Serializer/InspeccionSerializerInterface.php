<?php

namespace App\Fisca\Sdk\Client\Api\Serializer;


use App\Fisca\Sdk\Client\Model\Inspeccion;

interface InspeccionSerializerInterface
{

    public function serialize(Inspeccion $inspeccion): string;
}