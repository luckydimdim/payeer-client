<?php

namespace Payeer\Exceptions\Client;

use Throwable;

/**
 * Client level exception
 */
class IsOkException extends ClientException
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->message = "Error executing IsOk request: $message";
    }
}
