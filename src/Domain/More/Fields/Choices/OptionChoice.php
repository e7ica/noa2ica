<?php

namespace App\Domain\More\Fields\Choices;

class OptionChoice
{
    public function __construct(
        public string $label,
        public string $ref,
        public string $description,
        public bool $compliance
    ) {
    }

    public function toArray(): array
    {
        return [
            'label' => $this->label,
            'ref' => $this->ref,
            'description' => $this->description,
            'compliance' => $this->compliance,
        ];
    }
}