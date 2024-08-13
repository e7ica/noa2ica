<?php

namespace App\Tests\Fiska\Client;

class FiscaMockServer implements FiscaApiInterface
{

    public function __construct()
    {
        $this->server = new \GuzzleHttp\Server();
    }

}