<?php

namespace Payeer\Exceptions\Service;

class RequestCreationException extends ServiceException
{
    public $message = "Couldn't create a request.";
}
