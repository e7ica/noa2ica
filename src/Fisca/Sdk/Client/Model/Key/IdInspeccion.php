<?php

namespace App\Fisca\Sdk\Client\Model\Key;

class IdInspeccion
{
    public function __construct(
        public string $value
    ) {}

    public static function fromString($id): IdInspeccion
    {
        return new IdInspeccion($id);
    }

}