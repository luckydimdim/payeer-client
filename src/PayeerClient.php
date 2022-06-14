<?php

namespace Payeer;

use Payeer\Enums\Currency;
use Payeer\Exceptions\Client\IsOkException;
use Payeer\Exceptions\Service\ServiceException;
use Payeer\Responses\BalanceResponse;
use Payeer\Responses\IsOkResponse;
use Payeer\Responses\OrdersResponse;
use Payeer\Responses\RatesResponse;
use Payeer\Responses\StatsResponse;
use Payeer\Responses\TradesResponse;

/**
 * API operations facade.
 * Accept calls to API methods.
 * Returns response models or throws exceptions
 * in case of incorrect input parameters or API faults.
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
     * Checks API availability
     * @return IsOkResponse
     * @throws IsOkException
     */
    public function isOk(): IsOkResponse
    {
        try {
            return $this->service->isOk();
        } catch (ServiceException $ex) {
            throw new IsOkException($ex->getMessage());
        }
    }

    /**
     * Limits and currency pair rates request
     * @param array<array<Currency, Currency>> $currencyPairs
     * @return RatesResponse
     */
    public function rates(array $currencyPairs): RatesResponse
    {
        // TODO: implement corresponding client exceptions
        return $this->service->rates($currencyPairs);
    }

    /**
     * Prices change stats for the last 24 hours
     * @param array<array<Currency, Currency>> $currencyPairs
     * @return StatsResponse
     */
    public function stats(array $currencyPairs): StatsResponse
    {
        return $this->service->stats($currencyPairs);
    }

    /**
     * Prices change stats for the last 24 hours
     * @param array<array<Currency, Currency>> $currencyPairs
     * @return OrdersResponse
     */
    public function orders(array $currencyPairs): OrdersResponse
    {
        return $this->service->orders($currencyPairs);
    }

    /**
     * Trades history
     * @param array<array<Currency, Currency>> $currencyPairs
     * @return TradesResponse
     */
    public function trades(array $currencyPairs): TradesResponse
    {
        return $this->service->trades($currencyPairs);
    }

    /**
     * User's balance
     * @param array<array<Currency, Currency>> $currencyPairs
     * @return BalanceResponse
     */
    public function balance(array $currencyPairs): BalanceResponse
    {
        return $this->service->balance($currencyPairs);
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
