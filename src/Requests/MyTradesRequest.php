<?php

namespace Payeer\Requests;

use Payeer\Enums\Action;
use Payeer\Enums\HttpMethod;

/**
 * My trades history request model
 */
class MyTradesRequest extends RatesRequest
{
    public string $action = '';
    public ?int $date_from = null;
    public ?int $date_to = null;
    public ?int $append = null;
    public ?int $limit = null;

    /**
     * @param array<array<string, string>> $currencyPairs
     * @param Action $action
     * @param int|null $dateFrom
     * @param int|null $dateTo
     * @param int|null $lastOrderId
     * @param int|null $pagesize
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function __construct(
        array $currencyPairs = [],
        Action $action = Action::None,
        ?int $dateFrom = null,
        ?int $dateTo = null,
        ?int $lastOrderId = null,
        ?int $pageSize = null
    ) {
        parent::__construct($currencyPairs);

        $this->setMethod(HttpMethod::Post);
        $this->setUri('/trade/my_trades');

        $action = $action->value;
        $date_from = $dateFrom;
        $date_to = $dateTo;
        $append = $lastOrderId;
        $limit = $pageSize;
    }
}
