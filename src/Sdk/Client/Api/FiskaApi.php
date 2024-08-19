<?php

namespace App\Sdk\Client\Api;

use App\Fisca\Sdk\Client\Api\HttpClient;

class FiskaApi implements ApiFiskaInterface,
    ApiInspeccionInterface
{
    use InspeccionApi;

    public $httpClient = null;

    public function __construct(
        $url,
        $credentials
    )
    {
        $this->url = $url;
        $this->credentials = $credentials;
        $this->httpClient = new HttpClient(
            $url
        );

        $this->authenticate();
    }

    private function authenticate(): void
    {
        $this->httpClient->setCredentials($this->credentials);
        $this->httpClient->authenticate();
    }


}