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

    public ?int $date_from = null;
    public ?int $date_to = null;
    public ?int $append = null;
    public ?int $limit = null;

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function __construct(
        Status $status = Status::None,
        array $currencyPairs = [],
        Action $action = Action::None,
        ?int $dateFrom = null,
        ?int $dateTo = null,
        ?int $lastOrderId = null,
        ?int $pageSize = null
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
