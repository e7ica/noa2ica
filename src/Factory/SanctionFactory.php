<?php

namespace App\Factory;

use App\DTO\Sanction;

class SanctionFactory
{
    public static function fromArray(array $data): Sanction
    {
        return new Sanction(
            actions: $data['actions']
        );
    }
}