<?php

namespace App\Sdk\Client\Api\Serializer;


use App\Sdk\Client\Model\Inspeccion;

interface InspeccionSerializerInterface
{

    public function serialize(Inspeccion $inspeccion): string;
}