<?php

namespace App\Domain\Response\Answer;

class AnswerAttachment
{

    public function __construct(
        public string $url,
        public string $type,
        public string $name,
        public string $size,
    ) { }

    public function toArray(): array
    {
        return [
            'url' => $this->url,
            'type' => $this->type,
            'name' => $this->name,
            'size' => $this->size,
        ];
    }

}