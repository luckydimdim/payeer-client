<?php

namespace Payeer\Exceptions\Api;

/**
 * Api exceptions
 */
class ApiException extends \Exception
{
    public $message = "Ошибка взаимодействия с биржевым сервисом.";
}
