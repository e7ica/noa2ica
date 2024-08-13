<?php

namespace App\Domain;

class Store
{

    public function __construct(
        public string $id,
        public string $name
    )
    {
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }
}
