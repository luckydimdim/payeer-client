<?php

namespace Payeer\Requests;

/**
 * Available orders request model
 */
class OrdersRequest extends RatesRequest
{
    /**
     * @param array<array<string, string>> $currencyPairs
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function __construct(array $currencyPairs)
    {
        parent::__construct($currencyPairs);

        $this->setUri('/trade/orders');
    }
}
