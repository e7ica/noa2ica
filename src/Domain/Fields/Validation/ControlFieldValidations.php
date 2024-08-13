<?php

namespace App\Domain\Fields\Validation;

class ControlFieldValidations
{


    public function __construct(
        public bool $required,
        public bool $enforceable,
        public bool $rectifiable,
        public ?int $gracePeriodDays = null,
        public ?PenaltyLevels $penaltyLevels = null
    ) {
    }

    public function toArray(): array {
        return [
            'required' => $this->required,
            'enforceable' => $this->enforceable,
            'rectifiable' => $this->rectifiable,
            'grace_period_days' => $this->gracePeriodDays,
            'penalty_levels' => $this->penaltyLevels->toArray()
        ];
    }
}
