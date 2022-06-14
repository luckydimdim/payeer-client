<?php

namespace Payeer\Exceptions\Service;

class RequestNotFoundException extends ServiceException
{
    public $message = "Requested method not found.";
}
