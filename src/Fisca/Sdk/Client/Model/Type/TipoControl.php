<?php

namespace App\Fisca\Sdk\Client\Model\Type;

enum TipoControl: string
{
    case VARIAS_OPCIONES = 'VARIAS_OPCIONES';
    case VERIFICACION_MULTIPLE = 'VERIFICACION_MULTIPLE';
    case VERIFICACION_OBLIGATORIA = 'VERIFICACION_OBLIGATORIA';

}