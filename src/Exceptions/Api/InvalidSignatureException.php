<?php

namespace Payeer\Exceptions\Api;

class InvalidSignatureException extends ApiException
{
    public $message = "Возможные причины:
- неверная подпись API-SIGN
- неверно указан API-ID
- API-пользователь заблокирован (можно разблокировать в настройках)";
}
