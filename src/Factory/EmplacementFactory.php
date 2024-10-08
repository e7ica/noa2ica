<?php

namespace App\Factory;

use App\DTO\FormView\Emplacement;

class EmplacementFactory
{
    public static function fromArray(array $data): Emplacement
    {
        return new Emplacement(
            days: (int) $data['days'],
            actions: $data['actions']
        );
    }
}