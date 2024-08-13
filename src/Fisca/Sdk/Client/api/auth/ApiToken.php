<?php

namespace App\Fisca\Sdk\Client\api\auth;

class ApiToken
{

    public function __construct(
        public string $accessToken
    )
    { }

}