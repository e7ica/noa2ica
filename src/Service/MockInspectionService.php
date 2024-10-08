<?php

namespace App\Service;

use App\DTO\FormView\Emplacement;
use App\DTO\FormView\InspectionForm;
use App\DTO\FormView\Option;
use App\DTO\FormView\Question;
use App\DTO\FormView\Sanction;
use App\DTO\FormView\Summon;
use Psr\Log\LoggerInterface;
use Symfony\Component\Filesystem\Filesystem;

class MockInspectionService implements InspectionServiceInterface
{
    private array $inspections = [];
    private LoggerInterface $logger;

    public function __construct(
        LoggerInterface $logger
    )
    {
        $this->logger = $logger;
        $this->loadInspections();
    }

    private function loadInspections(): void
    {
        $filesystem = new Filesystem();
        $inspectionFiles = [
            __DIR__ . '/../data/inspection_1.json',
            __DIR__ . '/../data/inspection_2.json',
            __DIR__ . '/../data/inspection_3.json',
        ];

        foreach ($inspectionFiles as $file) {
            if ($filesystem->exists($file)) {
                $data = json_decode(file_get_contents($file), true);

                // Hidratar objeto InspectionForm
                $inspection = new InspectionForm(
                    $data['id'],
                    $data['title'],
                    $data['type'],
                    $data['business'],
                    $data['status']
                );

                // Hidratar preguntas (Question)
                $questions = [];
                $isfirst = true;
                $islast = false;
                $i = 0;
                foreach ($data['questions'] as $questionData) {
                    $i++;
                    if ($i === 1) {
                        $isfirst = true;
                    } else {
                        $isfirst = false;
                    }
                    if ($i === count($data['questions'])) {
                        $islast = true;
                    } else {
                        $islast = false;
                    }

                    // Hidratar opciones (Option)
                    $options = [];
                    foreach ($questionData['options'] as $optionData) {
                        $option = new Option(
                            $optionData['label'],
                            $optionData['value'],
                            $optionData['other'],
                            $optionData['compliance'],
                            $optionData['selected'] ?? false
                        );
                        $options[] = $option;
                    }

                    // Hidratar emplazamiento (Emplacement)
                    $emplacement = null;
                    if (isset($questionData['summon']['emplacement'])) {
                        $emplacement = new Emplacement(
                            $questionData['summon']['emplacement']['days'],
                            $questionData['summon']['emplacement']['actions']
                        );
                    }

                    // Hidratar sanción (Sanction)
                    $sanction = null;
                    if (isset($questionData['summon']['sanction'])) {
                        $sanction = new Sanction(
                            $questionData['summon']['sanction']['actions']
                        );
                    }

                    // Hidratar citación (Summon)
                    $summon = new Summon(
                        $questionData['summon']['can_emplacement'],
                        $emplacement,
                        $sanction,
                        $questionData['summon']['emplaced'] ?? false
                    );

                    // Hidratar la pregunta completa
                    $question = new Question(
                        $questionData['id'],
                        $questionData['ref'],
                        $questionData['label'],
                        $questionData['type'],
                        $questionData['status'],
                        $questionData['can_attach'],
                        $questionData['can_select_others'],
                        $questionData['can_emplacement'],
                        $isfirst,
                        $islast,
                        $questionData['group'],
                        $options,
                        $summon,
                        $questionData['comment'] ?? '',
                        $questionData['attachment'] ?? '',
                        $questionData['other_value'] ?? '',
                        $questionData['other_compliance'] ?? false
                    );

                    $questions[] = $question;
                }

                $inspection->questions = $questions;

                $this->inspections[] = $inspection;
            }
        }
    }


    public function getInspections(): array
    {
        return $this->inspections;
    }

    public function getInspectionById(int $id): ?InspectionForm
    {
        foreach ($this->inspections as $inspection) {
            if ($inspection->id === $id) {
                return $inspection;
            }
        }
        return null;
    }
}