<?php

namespace Payeer\Requests;

use Payeer\Enums\Currency;

/**
 * Available orders request model
 */
class OrdersRequest extends RatesRequest
{
    /**
     * @param array<array<Currency, Currency>> $currencyPairs
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function __construct(array $currencyPairs)
    {
        parent::__construct($currencyPairs);

        $this->setUri('/trade/orders');
    }
}
