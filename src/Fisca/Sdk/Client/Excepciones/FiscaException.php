<?php

namespace App\Fisca\Sdk\Client\Excepciones;
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