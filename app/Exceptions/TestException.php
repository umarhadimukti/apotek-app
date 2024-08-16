<?php

namespace App\Exceptions;

use Exception;

class TestException extends Exception
{
    public function __construct($message = 'ini testexception')
    {
        parent::__construct($message);
    }
}
