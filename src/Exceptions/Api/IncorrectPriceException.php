<?php

namespace Payeer\Exceptions\Api;

/**
 * Api exceptions
 */
class IncorrectPriceException extends ApiException
{
    public $message = "Цена выходит из допустимого диапазона (minPrice, maxPrice)";
}
