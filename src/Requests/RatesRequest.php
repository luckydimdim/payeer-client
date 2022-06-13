<?php

namespace Payeer\Requests;

use Payeer\Enums\Currency;
use Payeer\Enums\HttpMethod;

/**
 * Limits and pair rates request
 */
class RatesRequest extends RequestBase
{
    // TODO: handle conversion of $currencyPairs to $pair request param
    public string $pair;

    /**
     * @param array<array<Currency, Currency>> $currencyPairs
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function __construct(private readonly array $currencyPairs)
    {
        parent::__construct(HttpMethod::Get, '/trade/info');
    }
}
