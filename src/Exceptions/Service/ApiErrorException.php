<?php

namespace Payeer\Exceptions\Service;

use Throwable;

class ApiErrorException extends ServiceException
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->message = "API communication error: $message";
    }
}
