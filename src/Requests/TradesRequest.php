<?php

namespace Payeer\Requests;

/**
 * Trades history request model
 */
class TradesRequest extends RatesRequest
{
    /**
     * @param array<array<string, string>> $currencyPairs
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function __construct(array $currencyPairs)
    {
        parent::__construct($currencyPairs);

        $this->setUri('/trade/trades');
    }
}
