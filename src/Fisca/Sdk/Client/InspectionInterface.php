<?php

namespace App\Fisca\Sdk\Client;

interface InspectionInterface
{

    public function getInfo(): InspecionInfoResponse;

    public function getProtocolo(): GetProtocoloResponse;


}