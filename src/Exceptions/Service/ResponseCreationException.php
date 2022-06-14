<?php

namespace Payeer\Exceptions\Service;

class ResponseCreationException extends ServiceException
{
    public $message = "Couldn't create a response.";
}
