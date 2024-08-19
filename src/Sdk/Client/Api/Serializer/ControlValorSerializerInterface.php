<?php

namespace App\Sdk\Client\Api\Serializer;

use App\Sdk\Client\Model\ControlValor;

interface ControlValorSerializerInterface
{

    public function serialize(ControlValor $controlValor): string;


}