<?php

namespace App\Domain\Fields;

use App\Domain\Fields\Validation\ControlFieldValidations;

abstract class ControlField
{
    public string $fieldId;
    public string $title;
    public string $type;
    public string $ref;
    public ?string $description;
    public ControlFieldValidations $validations;

    public function __construct(
        string $fieldId,
        string $title,
        string $type,
        string $ref,
        ?string $description,
        ControlFieldValidations $validations
    ) {
        $this->fieldId = $fieldId;
        $this->title = $title;
        $this->type = $type;
        $this->ref = $ref;
        $this->description = $description;
        $this->validations = $validations;
    }

    abstract public function getProperties();


    public function toArray(): array {
        return [
            'field_id' => $this->fieldId,
            'title' => $this->title,
            'type' => $this->type,
            'ref' => $this->ref,
            'description' => $this->description,
            'validations' => $this->validations->toArray(),
            'properties' => $this->getProperties()->toArray()
        ];
    }
}