<?php

namespace App\Fisca\Sdk\Client\api\parsers;

use App\Fisca\Sdk\Client\Model\ControlValor;

interface ControlValorParserInterface
{
    public function parse($json_data): ControlValor;

}