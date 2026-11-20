<?php

namespace app\controllers\exceptions;

use Exception;
use Throwable;

class DataEmpty extends Exception
{
    public function __construct(string $message, $code = 0, ?Throwable $previous = null)
    {

        parent::__construct($message, $code, $previous);
    }
}
?>