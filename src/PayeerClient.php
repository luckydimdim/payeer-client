<?php

namespace Payeer;

use Payeer\Enums\Currency;
use Payeer\Responses\IsOkResponse;
use Payeer\Responses\RatesResponse;

/**
 * API operations facade
 */
class PayeerClient
{
    /**
     * @var IService API services
     */
    private readonly IService $service;

    /**
     * @var PayeerOrderClient order operations facade
     */
    private readonly PayeerOrderClient $order;

    public function __construct(string $uri, string $id)
    {
        $this->service = $this->createService($uri, $id);
        $this->order = new PayeerOrderClient($uri, $id, $this->service);
    }

    /**
     * Checks API health
     * @return IsOkResponse
     */
    public function isOk(): IsOkResponse
    {
        return $this->service->isOk();
    }

    /**
     * Limits and currency pair rates request
     * @param array<array<Currency, Currency>> $currencyPairs
     * @return RatesResponse
     */
    public function rates(array $currencyPairs): RatesResponse
    {
        return $this->service->rates($currencyPairs);
    }

    /**
     * Creates IService instance. Needed for testing purposes.
     * @param string $uri
     * @param string $id
     * @return Service
     */
    protected function createService(string $uri, string $id): Service
    {
        return new Service($uri, $id);
    }
}
