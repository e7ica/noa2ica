<?php

namespace App\Sdk\Client\Api;

use App\Sdk\Client\Model\Inspeccion;
use App\Sdk\Client\Model\Key\IdInspeccion;

trait InspeccionApi
{

    // Api path for inspeccion
    private $INSPECCION = '/inspecciones';

    public function inspeccionUri(IdInspeccion $id = null)
    {
        return $this->baseUri . $this->INSPECCION . '/' . $id->value;
    }

    /***
     * @param $id
     * @return mixed|null
     * @throws \Exception
     */
    public function getInspeccion(
        IdInspeccion $id
    ): ?Inspeccion
    {
        $uri = $this->inspeccionUri($id);
        $this->logger->info('Getting inspeccion', ['uri' => $uri]);
        $response = $this->httpClient->get( $uri );
        $this->logger->info('Response', ['status' => $response->getStatusCode()]);
        if($response->getStatusCode() == 200) {
            $json = json_decode($response->getBody()->getContents());
            $this->logger->info('Inspeccion', ['inspeccion' => $json]);
            return new Inspeccion($json);
        }
        if($response->getStatusCode() == 404) {
            $this->logger->error('Inspeccion not found');
            return null;
        }
        if($response->getStatusCode() == 401) {
            $this->logger->error('Unauthorized');
            throw new \Exception('Unauthorized');
        }
        if($response->getStatusCode() == 403) {
            $this->logger->error('Forbidden');
            throw new \Exception('Forbidden');
        }
        if($response->getStatusCode() == 500) {
            $this->logger->error('Internal server error');
            throw new \Exception('Internal server error');
        }
        throw new \Exception('Error getting inspeccion');
    }
}