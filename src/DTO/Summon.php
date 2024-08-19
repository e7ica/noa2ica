<?php

namespace App\DTO;

class Summon
{
    public function __construct(
        public readonly bool $canEmplacement,
        public readonly ?Emplacement $emplacement,
        public readonly ?Sanction $sanction,
        public bool $emplaced
    ) {}


    public function toArray(): array
    {
        return [
            'canEmplacement' => $this->canEmplacement,
            'emplacement' => $this->emplacement ? $this->emplacement->toArray() : null,
            'sanction' => $this->sanction ? $this->sanction->toArray() : null,
            'emplaced' => $this->emplaced
        ];
    }
}