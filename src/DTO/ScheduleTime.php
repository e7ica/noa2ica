<?php

namespace App\DTO\DetailView;

class ScheduleTime
{
    public function __construct(
        public readonly string $start,
        public readonly string $end,
        public readonly string $duration
    ) {
    }

    public function toArray(): array
    {
        return [
            'start' => $this->start,
            'end' => $this->end,
            'duration' => $this->duration
        ];
    }

}