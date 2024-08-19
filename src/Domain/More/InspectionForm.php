<?php

namespace App\Domain\More;

class InspectionForm
{
    public string $formId;
    public string $formName;
    public string $title;
    public string $description;
    public array $fields;

    public function __construct(
        string $formId,
        string $formName,
        string $title,
        string $description,
        array $fields
    ) {
        $this->formId = $formId;
        $this->formName = $formName;
        $this->title = $title;
        $this->description = $description;
        $this->fields = $fields;
    }

    public function toArray(): array {
        return [
            'form_id' => $this->formId,
            'form_name' => $this->formName,
            'title' => $this->title,
            'description' => $this->description,
            'fields' => array_map(function ($field) {
                return $field->toArray();
            }, $this->fields)
        ];
    }
}
