<?php

namespace Payeer\Requests;

use Payeer\Enums\HttpMethod;

/**
 * Limits and pair rates request
 */
class RatesRequest extends RequestBase
{
    public string $pair = '';

    /**
     * @param array<array<string, string>> $currencyPairs
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
     * @param array<array<string, string>> $currencyPairs
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
                $result[] = $currencyPair[0] . '_'. $currencyPair[1];
            }
        }

        return implode(',', $result);
    }

    /**
     * @param array<string, string> $currencyPair
     * @return bool
     * @throws \Exception TODO: introduce own exception types
     */
    public function validateParams(array $currencyPair): bool
    {
        if (count($currencyPair) !== 2) {
            throw new \Exception('Incorrect parameters format.');
        }

        if (!is_string($currencyPair[0]) || !is_string($currencyPair[1])) {
            throw new \Exception('Incorrect parameters type.');
        }

        if ($currencyPair[0] === $currencyPair[1]) {
            throw new \Exception('Incorrect parameters combination.');
        }

        return true;
    }
}
