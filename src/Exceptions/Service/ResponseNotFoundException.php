<?php

namespace Payeer\Exceptions\Service;

class ResponseNotFoundException extends ServiceException
{
    public $message = "Response not found.";
}
