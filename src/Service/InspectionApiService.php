<?php

// src/Service/InspectionApiService.php
namespace App\Service;

use App\Domain\InspectionForm;
use App\Domain\Fields\ControlField;
use App\Domain\Fields\MultipleChoiceControlField;
use App\Domain\Fields\YesNoControlField;
use App\Domain\Fields\DropdownControlField;
// Importa otros DTOs necesarios

class InspectionApiService
{
    private $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function getInspectionForm(string $formId): InspectionForm
    {
        $response = $this->httpClient->request('GET', "/api/inspection-forms/{$formId}");
        $data = $response->toArray();

        return new InspectionForm(
            $data['form_id'],
            $data['form_name'],
            $data['title'],
            $data['description'],
            $this->mapFields($data['fields'])
        );
    }

    private function mapFields(array $fields): array
    {
        return array_map(function ($fieldData) {
            switch ($fieldData['type']) {
                case 'multiple_choice':
                    return new MultipleChoiceControlField(/* mapea los datos */);
                case 'yes_no':
                    return new YesNoControlField(/* mapea los datos */);
                case 'dropdown':
                    return new DropdownControlField(/* mapea los datos */);
                // Añade más casos según tus tipos de campo
                default:
                    throw new \InvalidArgumentException("Tipo de campo desconocido: {$fieldData['type']}");
            }
        }, $fields);
    }
}