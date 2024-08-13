<?php

namespace App\Fisca\Sdk\Client\Api\Serializer;

use App\Fisca\Sdk\Client\Model\ControlValor;

interface ControlValorSerializerInterface
{

    public function serialize(ControlValor $controlValor): string;


}