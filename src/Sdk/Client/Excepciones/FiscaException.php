<?php

namespace App\Sdk\Client\Excepciones;
use App\Fisca\Sdk\Client\Excepciones\Exception;

class FiscaException extends Exception
{

    /**
     * @param string $string
     */
    public function __construct(string $string)
    {
        parent::__construct($string);
    }
}