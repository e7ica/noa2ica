<?php

namespace App\Domain\Response\Answer;


class ControlAnswer
{
    public function __construct(
        public AnswerField $field,
        public string $type,
        public ?array $choices = null,
        public ?AnswerChoice $choice = null,
        public ?bool $boolean = null,
        public ?array $attachments = null
    ) { }

    public function toArray(): array {
        $data = [
            'field' => $this->field->toArray(),
            'type' => $this->type
        ];

        if ($this->choices) {
            $data['choices'] = array_map(fn($choice) => $choice->toArray(), $this->choices);
        }

        if ($this->choice) {
            $data['choice'] = $this->choice->toArray();
        }

        if ($this->boolean) {
            $data['boolean'] = $this->boolean;
        }

        if ($this->attachments) {
            $data['attachments'] = array_map(fn($attachment) => $attachment->toArray(), $this->attachments);
        }

        return $data;
    }
}