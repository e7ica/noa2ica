<?php

namespace App\Sdk\Client\Model\State;

enum EstadoInspeccion: string
{
    case PENDIENTE = 'PENDIENTE';
    case EN_PROCESO = 'EN_PROCESO';
    case FINALIZADA = 'FINALIZADA';
    case CANCELADA = 'CANCELADA';
    case REPROGRAMADA = 'REPROGRAMADA';
    case SUSPENDIDA = 'SUSPENDIDA';
}