<?php

namespace Payeer\Requests;

use Payeer\Enums\Currency;
use Payeer\Enums\HttpMethod;

/**
 * Limits and pair rates request
 */
class RatesRequest extends RequestBase
{
    public string $pair = '';

    /**
     * @param array<array<Currency, Currency>> $currencyPairs
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function __construct(array $currencyPairs = [])
    {
        parent::__construct();

        $this->pair = $this->getPairs($currencyPairs);

        if (!$this->pair) {
            $this->setMethod(HttpMethod::Get);
        } else {
            $this->setMethod(HttpMethod::Post);
        }

        $this->setUri('/trade/info');
    }

    /**
     * @param array<array<Currency, Currency>> $currencyPairs
     * @return string "BTC_USD,BTS_RUB"
     * @throws \Exception
     */
    public function getPairs(array $currencyPairs): string
    {
        $result = [];

        if (!$currencyPairs) {
            return '';
        }

        foreach ($currencyPairs as $currencyPair) {
            if ($this->validateParams($currencyPair)) {
                $result[] = $currencyPair[0]->value . '_'. $currencyPair[1]->value;
            }
        }

        return implode(',', $result);
    }

    /**
     * @param array<Currency, Currency> $currencyPair
     * @return bool
     * @throws \Exception TODO: introduce own exception types
     * TODO: test this method
     */
    public function validateParams(array $currencyPair): bool
    {
        if (count($currencyPair) !== 2) {
            throw new \Exception('Incorrect parameters format.');
        }

        if (!$currencyPair[0] instanceof Currency
            || !$currencyPair[1] instanceof Currency) {
            throw new \Exception('Incorrect parameters type.');
        }

        if ($currencyPair[0] === $currencyPair[1]) {
            throw new \Exception('Incorrect parameters combination.');
        }

        return true;
    }
}
