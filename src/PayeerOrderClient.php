<?php

namespace Payeer;

use Payeer\Enums\Action;
use Payeer\Enums\Status;
use Payeer\Enums\Type;
use Payeer\Exceptions\Client\ClientException;
use Payeer\Exceptions\Service\ServiceException;
use Payeer\Responses\CancelResponse;
use Payeer\Responses\CreateResponse;
use Payeer\Responses\ListResponse;
use Payeer\Responses\StatusResponse;

/**
 * Group of order related operations.
 */
class PayeerOrderClient
{
    public function __construct(private readonly IService $service)
    { }

    /**
     * User's orders list
     * @param Status $status
     * @param array<array<string, string>> $currencyPairs
     * @param Action $action
     * @param int|null $dateFrom
     * @param int|null $dateTo
     * @param int|null $lastOrderId
     * @param int|null $pageSize
     * @return ListResponse
     * @throws ClientException
     */
    public function list(
        Status $status = Status::None,
        array $currencyPairs = [],
        Action $action = Action::None,
        ?int $dateFrom = null,
        ?int $dateTo = null,
        ?int $lastOrderId = null,
        ?int $pageSize = null
    ): ListResponse {
        try {
            return $this->service->list(
                $status,
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
     * Cancels orders by criteria or all of them
     * @param int|null $id
     * @param array<array<string, string>> $currencyPairs
     * @param Action $action
     * @return CancelResponse
     * @throws ClientException
     */
    public function cancel(
        ?int $id = null,
        array $currencyPairs = [],
        Action $action = Action::None): CancelResponse
    {
        try {
            return $this->service->cancel($id, $currencyPairs, $action);
        } catch (ServiceException $ex) {
            throw new ClientException($ex->getMessage());
        }
    }

    /**
     * Cancels orders by criteria or all of them
     * @param int $id
     * @return StatusResponse
     * @throws ClientException
     */
    public function status(int $id): StatusResponse
    {
        try {
            return $this->service->status($id);
        } catch (ServiceException $ex) {
            throw new ClientException($ex->getMessage());
        }
    }

    /**
     * Creates order
     * @param array<string, string> $currencyPairs
     * @param Type $type
     * @param Action $action
     * @param float $amount
     * @param float $price
     * @param float|null $stopPrice
     * @return CreateResponse
     * @throws ClientException
     */
    public function create(
        array $currencyPairs,
        Type $type,
        Action $action,
        float $amount,
        float $price,
        ?float $stopPrice = null
    ): CreateResponse {
        try {
            return $this->service->create(
                $currencyPairs, $type, $action, $amount, $price, $stopPrice);
        } catch (ServiceException $ex) {
            throw new ClientException($ex->getMessage());
        }
    }
}
