<?php

namespace App\Sdk\Client\Api\Parsers;

use App\Sdk\Client\Model\ControlValor;

interface ControlValorParserInterface
{
    public function parse($json_data): ControlValor;

}