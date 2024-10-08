<?php

namespace App\DTO\DetailView;

class Address
{
    public function __construct(
        public readonly string $street
    ) {
    }

    public function toArray(): array
    {
        return [
            'street' => $this->street
        ];
    }

}