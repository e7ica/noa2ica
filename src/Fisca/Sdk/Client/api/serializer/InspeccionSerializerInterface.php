<?php

namespace App\Fisca\Sdk\Client\api\serializer;


use App\Fisca\Sdk\Client\Model\Inspeccion;

interface InspeccionSerializerInterface
{

    public function serialize(Inspeccion $inspeccion): string;
}