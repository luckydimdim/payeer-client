<?php

namespace Payeer\Requests;

use Payeer\Enums\Action;
use Payeer\Enums\HttpMethod;
use Payeer\Enums\Status;

/**
 * User's orders list request model
 */
class ListRequest extends RatesRequest
{
    public string $action = '';

    // TODO: implement conditional serialization
    public string $status = '';

    public int $date_from = 0;
    public int $date_to = 0;
    public int $append = 0;
    public int $limit = 0;

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function __construct(
        Status $status,
        array $currencyPairs,
        Action $action,
        int $dateFrom = 0,
        int $dateTo = 0,
        int $lastOrderId = 0,
        int $pageSize = 0
    ) {
        parent::__construct($currencyPairs);

        $this->setMethod(HttpMethod::Post);

        // Separate API calls by status
        if ($status == Status::Opened) {
            $this->setUri('/trade/my_orders');
        } else {
            $this->setUri('/trade/my_history');
            $this->status = $status->value;
        }

        $this->action = $action->value;
        $this->date_from = $dateFrom;
        $this->date_to = $dateTo;
        $this->append = $lastOrderId;
        $this->limit = $pageSize;
    }
}
