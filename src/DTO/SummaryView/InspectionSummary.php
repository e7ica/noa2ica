<?php
namespace App\DTO\SummaryView;

class InspectionSummary
{
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly string $type,
        public readonly string $business,
        public string $status,
        public array $questions = []
    ) {
    }

    public function toArray(): array
    {   return [
            'id' => $this->id,
            'title' => $this->title,
            'type' => $this->type,
            'business' => $this->business,
            'status' => $this->status,
        ];
    }
}