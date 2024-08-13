<?php

namespace App\Fisca\Sdk\Client\api\auth;

class ApiCredentials
{
    public function __construct(
        public string $clientId,
        public string $clientSecret
    )
    { }

}