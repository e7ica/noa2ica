<?php

namespace App\DTO\FormView;

class Option
{
    public function __construct(
         public readonly string $label,
         public readonly string $value,
         public readonly bool   $other,
         public readonly bool   $compliance,
         public bool   $selected,
    ) {}


    public function toArray(): array
    {
        return [
            'label' => $this->label,
            'value' => $this->value,
            'other' => $this->other,
            'compliance' => $this->compliance,
            'selected' => $this->selected,
        ];
    }
}