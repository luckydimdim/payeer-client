<?php

namespace Payeer\Exceptions\Api;

class InvalidParameterException extends ApiException
{
    public $message = "Параметр parameter указан неверно";
}
