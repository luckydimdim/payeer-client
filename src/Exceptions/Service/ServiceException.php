<?php

namespace Payeer\Exceptions\Service;

class ServiceException extends \Exception
{
    public $message = 'Error during executing service request.';
}
