<?php

namespace App\Domain\More\Response;

use App\Domain\More\Inspector;
use App\Domain\More\Store;

class InspectionResponse
{

    public function __construct(
        public string $responseId,
        public \DateTime $submittedAt,
        public Inspector $inspector,
        public Store $store,
        public array $answers
    ) {
    }


    public function toArray(): array {
        return [
            'response_id' => $this->responseId,
            'submitted_at' => $this->submittedAt->format('Y-m-d H:i:s'),
            'inspector' => $this->inspector->toArray(),
            'store' => $this->store->toArray(),
            'answers' => array_map(function($answer) {
                return $answer->toArray();
            }, $this->answers)
        ];
    }
}