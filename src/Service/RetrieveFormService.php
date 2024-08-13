<?php

namespace App\Service;


use App\Domain\InspectionForm;
use App\Hidrator\FormHydrator;
use Psr\Log\LoggerInterface;

class RetrieveFormService
{

    private $json_files_by_id = [
       "1" => "form_sample_1.json",
       "2" => "form_sample_2.json"
    ];

    private FormHydrator $hidrator;

    private string $baseDir;

    public function __construct(
        private readonly LoggerInterface $logger
    )
    {
        $logger->info('RetrieveFormService loading...');
        # check path
        $logger->info(" current paht is " . getcwd());
        $this->baseDir = getcwd();
    }

    public function retrieveForm($formId): InspectionForm
    {
        # concat base path with json file path
        $jsonFilePath = $this->baseDir . "/data/" . $this->json_files_by_id[$formId];
        $this->logger->info("json file path is $jsonFilePath");
        $this->hidrator = new FormHydrator(
            $this->logger,
            $jsonFilePath
        );
        return $this->hidrator->hydrate();
    }

}