<?php

namespace Payeer\Exceptions\Api;

class AccessDeniedException extends ApiException
{
    public $message = "Доступ к API/ордеру запрещен. Проверьте ID заказа";
}
