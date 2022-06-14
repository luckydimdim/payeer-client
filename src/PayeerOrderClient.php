<?php

namespace Payeer;

use Payeer\Enums\Action;
use Payeer\Enums\Currency;
use Payeer\Enums\Status;
use Payeer\Enums\Type;
use Payeer\Responses\CancelResponse;
use Payeer\Responses\CreateResponse;
use Payeer\Responses\ListResponse;
use Payeer\Responses\StatusResponse;

/**
 * Group of order related operations.
 */
class PayeerOrderClient
{
    public function __construct(
        string $uri,
        string $id,
        private readonly IService $service
    ) { }

    /**
     * User's orders list
     * @param array<array<Currency, Currency>> $currencyPairs
     * @return ListResponse
     */
    public function list(
        Status $status,
        array $currencyPairs,
        Action $action,
        int $dateFrom = 0,
        int $dateTo = 0,
        int $lastOrderId = 0,
        int $pageSize = 0
    ): ListResponse {
        return $this->service->list(
            $status,
            $currencyPairs,
            $action,
            $dateFrom,
            $dateTo,
            $lastOrderId,
            $pageSize);
    }

    /**
     * Cancels orders by criteria or all of them
     * @param int|null $id
     * @param array<array<Currency, Currency>> $currencyPairs
     * @param Action $action
     * @return CancelResponse
     */
    public function cancel(
        ?int $id = null,
        array $currencyPairs = [],
        Action $action = Action::None): CancelResponse
    {
        return $this->service->cancel($id, $currencyPairs, $action);
    }

    /**
     * Cancels orders by criteria or all of them
     * @param int $id
     * @return StatusResponse
     */
    public function status(int $id): StatusResponse
    {
        return $this->service->status($id);
    }

    /**
     * Creates order
     * @param array<Currency, Currency> $currencyPairs
     * @param Type $type
     * @param Action $action
     * @param float $amount
     * @param float $price
     * @return CreateResponse
     */
    public function create(
        array $currencyPairs,
        Type $type,
        Action $action,
        float $amount,
        float $price
    ): CreateResponse {
        return $this->service->create(
            $currencyPairs, $type, $action, $amount, $price);
    }
}
