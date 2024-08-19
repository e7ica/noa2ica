<?php
// src/DataFixtures/InspectionFixture.php

namespace App\DataFixtures;


use App\Entity\Inspection;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

class InspectionFixture
{
    public function load(ObjectManager $manager)
    {
        $filesystem = new Filesystem();
        $inspectionFiles = [
            'inspection_1.json',
            'inspection_2.json',
            'inspection_3.json',
        ];

        foreach ($inspectionFiles as $file) {
            $path = __DIR__ . '/data/' . $file;
            if ($filesystem->exists($path)) {
                $data = json_decode(file_get_contents($path), true);

                $inspection = new Inspection();
                // Aquí hidratas el objeto Inspection con los datos del JSON
                $inspection->setTitle($data['title']);
                $inspection->setType($data['type']);
                // Continúa asignando todos los campos...

                $manager->persist($inspection);
            }
        }

        $manager->flush();
    }
}
