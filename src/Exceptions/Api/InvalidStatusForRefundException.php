<?php

namespace Payeer\Exceptions\Api;

class InvalidStatusForRefundException extends ApiException
{
    public $message = "Статус status ордера не позволяет произвести возврат (ордер уже возвращен или отменен)";
}
