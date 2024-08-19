<?php

namespace App\Sdk\Client\Api\Auth;

class ApiCredentials
{
    public function __construct(
        public string $clientId,
        public string $clientSecret
    )
    { }

}