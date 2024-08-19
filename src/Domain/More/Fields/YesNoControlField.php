<?php

namespace App\Domain\More\Fields;


use App\Domain\More\Fields\Properties\YesNoControlFieldProperties;
use App\Domain\More\Fields\Validation\ControlFieldValidations;

class YesNoControlField extends ControlField
{

    private YesNoControlFieldProperties $properties;

    public function __construct(
        string                  $fieldId,
        string                  $title,
        string                  $type,
        string                  $ref,
        ?string                 $description,
        ControlFieldValidations $validations,
        YesNoControlFieldProperties $properties
    ) {
        parent::__construct($fieldId, $title, $type, $ref, $description, $validations);
        $this->properties = $properties;
    }

    public function getProperties(): YesNoControlFieldProperties
    {
        return $this->properties;
    }
}
