<?php

namespace App\Domain\More\Response\Answer;

class AnswerField
{
    public function __construct(
        public int $sort,
        public string $id,
        public string $ref,
        public string $type
    )
    { }

    public function toArray(): array {
        return [
            'sort' => $this->sort,
            'id' => $this->id,
            'ref' => $this->ref,
            'type' => $this->type
        ];
    }
}