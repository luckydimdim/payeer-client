<?php

namespace Payeer\Exceptions\Api;

class LimitExceededException extends ApiException
{
    public $message = "Превышение установленных лимитов (количество запросов/весов/ордеров), подробнее указано в параметре desc";
}
