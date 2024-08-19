<?php

namespace App\Factory;

use App\DTO\Summon;

class SummonFactory
{
    public static function fromArray(array $data): Summon
    {
        $emplacement = isset($data['emplacement']) ? EmplacementFactory::fromArray($data['emplacement']) : null;
        $sanction = isset($data['sanction']) ? SanctionFactory::fromArray($data['sanction']) : null;

        return new Summon(
            canEmplacement: $data['can_emplacement'],
            emplacement: $emplacement,
            sanction: $sanction
        );
    }
}