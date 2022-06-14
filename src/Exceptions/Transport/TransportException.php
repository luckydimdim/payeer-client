<?php

namespace Payeer\Exceptions\Transport;

class TransportException extends \Exception
{
    public $message = 'Service communication error.';
}
