<?php

namespace App\Domain\More\Fields;

use App\Domain\More\Fields\Properties\MultipleChoiceControlFieldProperties;
use App\Domain\More\Fields\Validation\ControlFieldValidations;

class MultipleChoiceControlField extends ControlField
{
    private MultipleChoiceControlFieldProperties $properties;

    public function __construct(
        string                        $fieldId,
        string                        $title,
        string                        $type,
        string                        $ref,
        ?string                       $description,
        ControlFieldValidations       $validations,
        MultipleChoiceControlFieldProperties $properties
    ) {
        parent::__construct($fieldId, $title, $type, $ref, $description, $validations);
        $this->properties = $properties;
    }

    public function getProperties(): MultipleChoiceControlFieldProperties
    {
        return $this->properties;
    }

    public function toArray(): array {
        $array = parent::toArray();
        $array['choices'] = $this->properties->getChoices();
        return $array;
    }


}
