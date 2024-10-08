<?php
namespace App\DTO\SheetView;

use App\DTO\DetailView\Address;
use App\DTO\DetailView\ScheduleTime;

class InspectionSheet
{
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly string $type,
        public readonly string $business,
        public string $status,
        public Address $address,
        public ScheduleTime $scheduleTime,
        public array $contacts,
        public array $owners,
        public array $relatedInspections,
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