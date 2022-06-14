<?php

namespace Payeer\Exceptions\Api;

/**
 * Api exceptions
 */
class InsufficientFundsException extends ApiException
{
    public $message = "Недостаточно средств для создания ордера (maxAmount, maxValue)";
}
