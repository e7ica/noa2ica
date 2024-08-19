<?php

namespace App\Sdk\Client;

use App\Fisca\Sdk\Client\GetProtocoloResponse;
use App\Fisca\Sdk\Client\InspecionInfoResponse;

interface InspectionInterface
{

    public function getInfo(): InspecionInfoResponse;

    public function getProtocolo(): GetProtocoloResponse;


}