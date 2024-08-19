<?php

namespace App\Sdk\Client\Model\Key;

class IdProtocolo
{

    public function __construct(
        public string $value
    ) {}

    public static function fromString($id): IdProtocolo
    {
        return new IdProtocolo($id);
    }

}