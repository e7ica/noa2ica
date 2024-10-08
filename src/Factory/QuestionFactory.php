<?php

namespace App\Factory;

use App\DTO\FormView\Question;

class QuestionFactory
{
    public static function fromArray(array $data): Question
    {
        $options = array_map(fn($option) => OptionFactory::fromArray($option), $data['options']);
        $summon = SummonFactory::fromArray($data['summon']);

        return new Question(
            id: $data['id'],
            ref: $data['ref'],
            type: $data['type'],
            status: $data['status'],
            label: $data['label'],
            canAttach: $data['can_attach'],
            canSelectOthers: $data['can_select_others'],
            canEmplacement: $data['can_emplacement'],
            first: $data['first'],
            last: $data['last'],
            group: $data['group'],
            options: $options,
            summon: $summon,
            comment: $data['comment'],
            otherValue: $data['other_value'],
            otherCompliance: $data['other_compliance']
        );
    }
}