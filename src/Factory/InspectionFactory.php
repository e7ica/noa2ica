<?php

namespace App\Factory;

use App\DTO\FormView\InspectionForm;

class InspectionFactory
{
    public static function fromArray(array $data): InspectionForm
    {
        try {
            return new InspectionForm(
                id: (int)$data['id'],
                title: $data['title'],
                type: $data['type'],
                business: $data['business'],
                address: $data['address'],
                time: $data['time'],
                number: $data['number'],
                initials: $data['initials'],
                status: $data['status'],
                inspector: $data['inspector'],
                date: new \DateTimeImmutable($data['date']),
                observations: $data['observations']
            );
        } catch (\Exception $e) {
            throw new \Exception('Error creating InspectionForm object: ' . $e->getMessage());
        }
    }
}