<?php

namespace Payeer;

use Payeer\Enums\Action;
use Payeer\Enums\Currency;
use Payeer\Exceptions\Client\ClientException;
use Payeer\Exceptions\Client\IsOkException;
use Payeer\Exceptions\Service\ServiceException;
use Payeer\Responses\BalanceResponse;
use Payeer\Responses\IsOkResponse;
use Payeer\Responses\MyTradesResponse;
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
    protected readonly IService $service;

    /**
     * @var PayeerOrderClient order operations facade
     */
    public readonly PayeerOrderClient $order;

    /**
     * @param string $id
     * @param string $key
     * @param string $uri
     * @throws ClientException
     */
    public function __construct(
        string $id,
        string $key,
        string $uri = 'https://payeer.com/api/trade'
    ) {
        $this->service = $this->createService($id, $key, $uri);
        $this->order = new PayeerOrderClient($this->service);
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
     * @throws ClientException
     */
    public function rates(array $currencyPairs = []): RatesResponse
    {
        try {
            return $this->service->rates($currencyPairs);
        } catch (ServiceException $ex) {
            // TODO: implement corresponding client exceptions
            throw new ClientException($ex->getMessage());
        }
    }

    /**
     * Prices change stats for the last 24 hours
     * @param array<array<Currency, Currency>> $currencyPairs
     * @return StatsResponse
     * @throws ClientException
     */
    public function stats(array $currencyPairs): StatsResponse
    {
        try {
            return $this->service->stats($currencyPairs);
        } catch (ServiceException $ex) {
            throw new ClientException($ex->getMessage());
        }
    }

    /**
     * Prices change stats for the last 24 hours
     * @param array<array<Currency, Currency>> $currencyPairs
     * @return OrdersResponse
     * @throws ClientException
     */
    public function orders(array $currencyPairs): OrdersResponse
    {
        try {
            return $this->service->orders($currencyPairs);
        } catch (ServiceException $ex) {
            throw new ClientException($ex->getMessage());
        }
    }

    /**
     * Trades history
     * @param array<array<Currency, Currency>> $currencyPairs
     * @return TradesResponse
     * @throws ClientException
     */
    public function trades(array $currencyPairs): TradesResponse
    {
        try {
            return $this->service->trades($currencyPairs);
        } catch (ServiceException $ex) {
            throw new ClientException($ex->getMessage());
        }
    }

    /**
     * My trades history
     * @param array<array<Currency, Currency>> $currencyPairs
     * @param Action $action
     * @param int|null $dateFrom
     * @param int|null $dateTo
     * @param int|null $lastOrderId
     * @param int|null $pageSize
     * @return MyTradesResponse
     * @throws ClientException
     */
    public function myTrades(
        array $currencyPairs = [],
        Action $action = Action::None,
        ?int $dateFrom = null,
        ?int $dateTo = null,
        ?int $lastOrderId = null,
        ?int $pageSize = null): MyTradesResponse
    {
        try {
            return $this->service->myTrades(
                $currencyPairs,
                $action,
                $dateFrom,
                $dateTo,
                $lastOrderId,
                $pageSize);
        } catch (ServiceException $ex) {
            throw new ClientException($ex->getMessage());
        }
    }

    /**
     * User's balance
     * @return BalanceResponse
     * @throws ClientException
     */
    public function balance(): BalanceResponse
    {
        try {
            return $this->service->balance();
        } catch (ServiceException $ex) {
            throw new ClientException($ex->getMessage());
        }
    }

    /**
     * Creates IService instance. Needed for testing purposes.
     * @param string $id
     * @param string $key
     * @param string $uri
     * @return Service
     * @throws ClientException
     */
    protected function createService(string $id, string $key, string $uri): Service
    {
        try {
            return new Service($id, $key, $uri);
        } catch (ServiceException $ex) {
            throw new ClientException($ex->getMessage());
        }
    }
}
