<?php

namespace Payeer\Exceptions\Api;

/**
 * Api exceptions
 */
class InvalidDateRangeException extends ApiException
{
    public $message = "Неверно указан диапазон дат для фильтрации (период не должен превышать 32 дня)";
}
