<?php

namespace App\DTO\DetailView;

class Owner
{

    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $dni
    ) {
    }

}