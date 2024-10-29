<?php

namespace App\DTO;

use App\DTO\DetailView\Address;

readonly class Contribuyente
{

    public function __construct(
        public int     $id,
        public string  $businessName,
        public string  $businessType,
        public Address $businessAddress,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'businessName' => $this->businessName,
            'businessType' => $this->businessType,
            'businessAddress' => $this->businessAddress->toArray(),
        ];
    }
}