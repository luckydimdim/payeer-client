<?php

namespace Payeer\Exceptions\Api;

/**
 * Api exceptions
 */
class MinValueException extends ApiException
{
    public $message = "Сумма ордера меньше минимальной minValue для выбранной пары";
}
