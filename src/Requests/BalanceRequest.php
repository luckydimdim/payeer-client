<?php

namespace Payeer\Requests;

use Payeer\Enums\HttpMethod;

/**
 * User's balance
 */
class BalanceRequest extends RequestBase
{
    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function __construct()
    {
        parent::__construct();

        $this->setMethod(HttpMethod::Post);
        $this->setUri('/trade/account');
    }
}
