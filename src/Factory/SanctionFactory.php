<?php

namespace App\Factory;

use App\DTO\FormView\Sanction;

class SanctionFactory
{
    public static function fromArray(array $data): Sanction
    {
        return new Sanction(
            actions: $data['actions']
        );
    }
}