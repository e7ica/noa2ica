<?php
namespace App\DTO\HistoryView;

use App\DTO\DetailView\Address;
use App\DTO\DetailView\ScheduleTime;

readonly class InspectionItem
{
    public function __construct(
        public int    $id,
        public string $title,
        public readonly string $type,
        public readonly string $business,
        public string $status,
        public Address $address,
        public string $releaseDate,
        public string $inspector,
        public string $observations
//        public array $contacts,
//        public array $owners,
//        public array $relatedInspections,
//        public InspectionItem $parent,
    ) {
    }

    public function toArray(): array
    {   return [
            'id' => $this->id,
            'title' => $this->title,
            'type' => $this->type,
            'business' => $this->business,
            'status' => $this->status,
            'address' => $this->address->street,
            'releaseDate' => $this->releaseDate,
            'inspector' => $this->inspector,
            'observations' => $this->observations,
//            'parent' => $this->parent->toArray(),
        ];
    }
}