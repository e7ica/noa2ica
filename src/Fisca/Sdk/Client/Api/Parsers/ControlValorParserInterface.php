<?php

namespace App\Fisca\Sdk\Client\Api\Parsers;

use App\Fisca\Sdk\Client\Model\ControlValor;

interface ControlValorParserInterface
{
    public function parse($json_data): ControlValor;

}