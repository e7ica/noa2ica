<?php

namespace App\Domain\More\Response\Answer;

class AnswerChoice
{
    public function __construct(
        public string $label,
        public string $ref
    )
    { }

    public function toArray(): array {
        return [
            'label' => $this->label,
            'ref' => $this->ref
        ];
    }
}