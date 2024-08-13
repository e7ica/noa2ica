<?php

namespace App\Domain\Fields;

use App\Domain\Fields\Properties\DropdownControlFieldProperties;
use App\Domain\Fields\Validation\ControlFieldValidations;

class DropdownControlField extends ControlField
{
    private DropdownControlFieldProperties $properties;

    public function __construct(
        string                  $fieldId,
        string                  $title,
        string                  $type,
        string                  $ref,
        ?string                 $description,
        ControlFieldValidations $validations,
        DropdownControlFieldProperties $properties
    ) {
        parent::__construct($fieldId, $title, $type, $ref, $description, $validations);
        $this->properties = $properties;
    }

    public function getProperties(): DropdownControlFieldProperties
    {
        return $this->properties;
    }


    public function toArray(): array {
        $array = parent::toArray();
        $array['choices'] = $this->properties->getChoices();
        return $array;
    }
}
