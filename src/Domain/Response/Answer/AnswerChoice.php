<?php

namespace App\Domain\Response\Answer;

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