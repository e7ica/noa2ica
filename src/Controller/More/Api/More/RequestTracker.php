<?php

namespace App\Controller\More\Api\More;

use Symfony\Component\Uid\Uuid;

trait RequestTracker
{

    // generate a uuid for request reference;
    public function makeRequestId(): string
    {
        return substr(Uuid::v1()->toString(), -4);
    }


}