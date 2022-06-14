<?php

namespace Payeer\Exceptions\Api;

/**
 * Api exceptions
 */
class UnknownErrorException extends ApiException
{
    public $message = "Неизвестная ошибка на бирже. Торги приостановлены для проверки. Попробуйте через 15 минут.";
}
