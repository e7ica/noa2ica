<?php

namespace App\Factory;

use App\DTO\FormView\Option;

class OptionFactory
{
    public static function fromArray(array $data): Option
    {
        return new Option(
            label: $data['label'],
            value: $data['value'],
            other: $data['other'],
            compliance: $data['compliance']
        );
    }
}