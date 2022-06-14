<?php

namespace Payeer\Exceptions\Api;

/**
 * Api exceptions
 */
class InsufficientVolumeException extends ApiException
{
    public $message = "Недостаточно объема для создания ордера (maxAmount, maxValue)";
}
