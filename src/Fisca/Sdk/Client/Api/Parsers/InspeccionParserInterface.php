<?php

namespace App\Fisca\Sdk\Client\Api\Parsers;

use App\Fisca\Sdk\Client\Model\Inspeccion;

interface InspeccionParserInterface
{

    public function parse($json_data): Inspeccion;

}