<?php

namespace App\Domain\Fields\Validation;

class PenaltyLevels
{
    public function __construct(
        public bool $infringement,
        public bool $closure
    )
    { }


    public function toArray(): array {
        return [
            'infringement' => $this->infringement,
            'closure' => $this->closure
        ];
    }
}