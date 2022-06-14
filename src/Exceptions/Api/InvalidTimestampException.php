<?php

namespace Payeer\Exceptions\Api;

class InvalidTimestampException extends ApiException
{
    public $message = "Параметр ts указан неверно:
- запрос шел до сервера API более 60 секунд
- на вашем сервере неверное время, настройте синхронизацию";
}
