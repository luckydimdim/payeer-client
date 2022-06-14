<?php

namespace Payeer\Exceptions\Client;

/**
 * Client level exceptions
 */
class ClientException extends \Exception
{
    public $message = 'Payeer Client error';
}
