<?php

namespace App\DTO\DetailView;

class Contact
{

    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $email,
        public readonly string $phone
    ) {
    }

}