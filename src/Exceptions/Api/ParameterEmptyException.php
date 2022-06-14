<?php

namespace Payeer\Exceptions\Api;

class ParameterEmptyException extends ApiException
{
    public $message = "Параметр parameter обязателен (не должен быть пустым)";
}
