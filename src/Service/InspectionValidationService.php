<?php

namespace App\Service;

use App\Domain\InspectionForm;
use App\Domain\Fields\MultipleChoiceControlField;

class InspectionValidationService
{
    public function validate(array $data, InspectionForm $form): array
    {
        $errors = [];

        foreach ($form->fields as $field) {
            if ($field instanceof MultipleChoiceControlField) {
                if ($field->validations->required && empty($data[$field->ref])) {
                    $errors[$field->ref] = "Este campo es obligatorio.";
                }
                // Agregar más validaciones según sea necesario
            }
            // Agregar validaciones para otros tipos de campos
        }

        return $errors;
    }
}