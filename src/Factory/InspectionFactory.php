<?php

namespace App\Factory;

use App\DTO\Inspection;

class InspectionFactory
{
    public static function fromArray(array $data): Inspection
    {
        try {
            return new Inspection(
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
            throw new \Exception('Error creating Inspection object: ' . $e->getMessage());
        }
    }
}