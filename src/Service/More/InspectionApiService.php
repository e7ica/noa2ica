<?php

// src/Service/InspectionApiService.php
namespace App\Service\More;

use App\Domain\More\Fields\DropdownControlField;
use App\Domain\More\Fields\MultipleChoiceControlField;
use App\Domain\More\Fields\YesNoControlField;
use App\Domain\More\InspectionForm;
use App\Service\HttpClientInterface;

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
        $response = $this->httpClient->request('GET', "/api/inspection-control_form/{$formId}");
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