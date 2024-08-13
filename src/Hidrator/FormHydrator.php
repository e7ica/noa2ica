<?php

namespace App\Hidrator;

use App\Domain\Fields\Choices\OptionChoice;
use App\Domain\Fields\MultipleChoiceControlField;
use App\Domain\Fields\Properties\MultipleChoiceControlFieldProperties;
use App\Domain\Fields\Properties\YesNoControlFieldProperties;
use App\Domain\Fields\Validation\ControlFieldValidations;
use App\Domain\Fields\Validation\PenaltyLevels;
use App\Domain\Fields\YesNoControlField;
use App\Domain\InspectionForm;
use Psr\Log\LoggerInterface;

readonly class FormHydrator
{

    public function __construct(
        private LoggerInterface $logger,
        private string          $jsonFilePath
    ) {
        $this->logger->info('FormHydrator loading...');
    }

    public function hydrate(): InspectionForm
    {
        $this->logger->info('Hydrating form...');
        $jsonData = file_get_contents($this->jsonFilePath);
        $data = json_decode($jsonData, true);
        $this->logger->info('json data loaded');

        return $this->createInspectionForm($data);
    }

    private function createInspectionForm(array $data): InspectionForm
    {
        $this->logger->info('Creating InspectionForm...');

        $formData = $data[0]; // Asumimos que hay un solo formulario

        $fields = array_map(function ($fieldData) {
            $this->logger->info('Creating field...');

            $penaltyLevels = isset($fieldData['validations']['penalty_levels'])
                ? new PenaltyLevels(
                    $fieldData['validations']['penalty_levels']['infringement'],
                    $fieldData['validations']['penalty_levels']['closure']
                )
                : null;

            $validations = new ControlFieldValidations(
                $fieldData['validations']['required'],
                $fieldData['validations']['enforceable'],
                $fieldData['validations']['rectifiable'],
                $fieldData['validations']['grace_period_days'] ?? null,
                $penaltyLevels
            );

            $this->logger->info('Creating properties...');

            $propertiesData = $fieldData['properties'];
            $choices = array_map(function ($choiceData) {
                $this->logger->info('Creating choice...');
                $this->logger->info('[ choice data ]  ' . json_encode($choiceData));
                $choice =  new OptionChoice(
                    $choiceData['label'],
                    $choiceData['ref'],
                    $choiceData['description'],
                    filter_var($choiceData['compliance'], FILTER_VALIDATE_BOOLEAN)
                );
                $this->logger->info('Choice created');
                $this->logger->info('[ choice ]  ' . json_encode($choice));
                return $choice;
            }, $propertiesData['choices']);

            if ($fieldData['type'] === 'multiple_choice') {
                $this->logger->info('Creating MultipleChoiceControlField...');
                $properties = new MultipleChoiceControlFieldProperties(
                    $propertiesData['allow_attachments'],
                    $propertiesData['allow_multiple_selection'],
                    $propertiesData['allow_other_choice'] ?? false,
                    $propertiesData['randomize'] ?? false,
                    $propertiesData['vertical_alignment'] ?? false,
                    $choices,
                    $propertiesData['description'] ?? null
                );

                $this->logger->info('Field created');
                return new MultipleChoiceControlField(
                    $fieldData['field_id'],
                    $fieldData['title'],
                    $fieldData['type'],
                    $fieldData['ref'],
                    $fieldData['description'] ?? null,
                    $validations,
                    $properties
                );
            } elseif ($fieldData['type'] === 'yes_no') {
                $this->logger->info('Creating YesNoControlField...');
                $properties = new YesNoControlFieldProperties(
                    $propertiesData['description'] ?? null
                );

                $this->logger->info('Field created');
                return new YesNoControlField(
                    $fieldData['field_id'],
                    $fieldData['title'],
                    $fieldData['type'],
                    $fieldData['ref'],
                    $fieldData['description'] ?? null,
                    $validations,
                    $properties
                );
            }
        }, $formData['fields']);

        $this->logger->info('InspectionForm created');

        return new InspectionForm(
            $formData['form_id'],
            $formData['form_name'],
            $formData['title'],
            $formData['description'] ?? null,
            $fields
        );
    }
}
