<?php

namespace App\Service\More;


use App\Hidrator\More\ResponseHydrator;
use Psr\Log\LoggerInterface;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouterInterface;

class RetrieveResponseService
{

    private $json_files_by_id = [
        "1" => "retrieve_sample_1.json",
        "2" => "retrieve_sample_2.json"
    ];

    private string $baseDir;
    private string $baseUrl;

    public function __construct(
        private LoggerInterface  $logger,
        private RequestContext $context,
        private RouterInterface $router

    )
    {
        $this->logger->info('RetrieveResponseService was created');
        $this->baseDir = getcwd();
        $this->baseUrl = $this->router->getContext()->getBaseUrl();
        $this->logger->info("Current path is " . $this->baseDir);
    }

    public function retrieveLastResponse(int $inspection_id): \App\Domain\More\Response\InspectionResponse
    {
        $jsonFilePath = $this->baseDir . "/data/" . $this->json_files_by_id[$inspection_id];
        $this->logger->info("json file path is $jsonFilePath");
        $hydrator = new ResponseHydrator(
            $this->logger,
            $this->router,
            $jsonFilePath
        );
        $this->logger->info("[context]", [$this->context->getBaseUrl(), $this->context->getScheme(), $this->context->getHost(), $this->context->getHttpPort()]);
        // make a common url for http://{host}:{port}/{baseurl}
        // $hydrator->basdeUrl = $this->context->getScheme() . "://" . $this->context->getHost() . ":" . $this->context->getHttpPort() . $this->context->getBaseUrl();
        return $hydrator->hydrate();
    }

}
