<?php

namespace App\DTO;

use App\DTO\DetailView\Address;

readonly class Inspector
{

    public function __construct(
        public int     $id,
        public string  $name,
        public string  $dni,
        public Address $address,
        public string  $phone
    ) {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'dni' => $this->dni,
            'address' => $this->address->toArray(),
            'phone' => $this->phone
        ];
    }

}