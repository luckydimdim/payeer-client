<?php

namespace Payeer\Exceptions\Api;

/**
 * Api exceptions
 */
class RefundLimitException extends ApiException
{
    public $message = "Ордер может быть отменен не менее через 1 минуту после создания";
}
