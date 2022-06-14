<?php

namespace Payeer\Exceptions\Api;

/**
 * Api exceptions
 */
class InvalidIpAddressException extends ApiException
{
    public $message = "IP-адрес ip источника запроса не совпадает с тем, который прописан в настройках API";
}
