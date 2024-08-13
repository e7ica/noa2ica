<?php

namespace App\Domain\Fields\Properties;

class ControlFieldProperties
{
    public ?string $description;
    public bool $allowAttachments;

    public function toArray(): array {
        return [
            'description' => $this->description,
            'allow_attachments' => $this->allowAttachments
        ];
    }
}