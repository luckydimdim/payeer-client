<?php

namespace Payeer\Exceptions\Api;

/**
 * Api exceptions
 */
class MinAmountException extends ApiException
{
    public $message = "Количество меньше минимального minAmount для выбранной пары";
}
