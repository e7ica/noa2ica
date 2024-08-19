<?php

namespace App\Sdk\Client\Api\Auth;

class ApiToken
{

    public function __construct(
        public string $accessToken
    )
    { }

}