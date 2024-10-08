<?php

namespace App\DTO\FormView;

readonly class Sanction
{
    public function __construct(
        public array $actions // array of strings
    ) {}

    public function toArray(): array
    {
        return [
            'actions' => $this->actions
        ];
    }
}