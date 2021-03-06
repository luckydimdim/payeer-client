<?php

namespace Payeer\Requests;

use Payeer\Enums\HttpMethod;

/**
 * Checks API connection
 */
class IsOkRequest extends RequestBase
{
    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function __construct()
    {
        parent::__construct();

        $this->setMethod(HttpMethod::Get);
        $this->setUri('/trade/info');
    }
}
