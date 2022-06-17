<?php

namespace Payeer\Requests;

/**
 * Prices change stats for the last 24 hours
 */
class StatsRequest extends RatesRequest
{
    /**
     * @param array<array<string, string>> $currencyPairs
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function __construct(array $currencyPairs = [])
    {
        parent::__construct($currencyPairs);

        $this->setUri('/trade/ticker');
    }
}
