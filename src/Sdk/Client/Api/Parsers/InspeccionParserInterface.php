<?php

namespace App\Sdk\Client\Api\Parsers;

use App\Sdk\Client\Model\Inspeccion;

interface InspeccionParserInterface
{

    public function parse($json_data): Inspeccion;

}