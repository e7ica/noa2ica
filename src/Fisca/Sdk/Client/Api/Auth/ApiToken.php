<?php

namespace App\Fisca\Sdk\Client\Api\Auth;

class ApiToken
{

    public function __construct(
        public string $accessToken
    )
    { }

}