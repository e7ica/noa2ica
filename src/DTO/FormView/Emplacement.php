<?php

namespace App\DTO\FormView;

readonly class Emplacement
{
    public function __construct(
        public int   $days,
        public array $actions // array of strings
    ) {}

    public function toArray(): array
    {
        return [
            'days' => $this->days,
            'actions' => $this->actions
        ];
    }
}