<?php

namespace Payeer\Exceptions\Transport;

class SendRequestException extends TransportException
{
    public $message = 'Error during sending request to remote server';
}
