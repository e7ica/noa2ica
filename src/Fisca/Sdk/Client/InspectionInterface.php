<?php

namespace App\Fisca\Sdk;

interface InspectionInterface
{

    public function getInfo(): InspecionInfoResponse;

    public function getProtocolo(): GetProtocoloResponse;


}