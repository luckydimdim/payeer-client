<?php

namespace Payeer\Requests;

use Payeer\Enums\Action;
use Payeer\Enums\Currency;
use Payeer\Enums\HttpMethod;

/**
 * Cancel one or more orders
 */
class CancelRequest extends RatesRequest
{
    /**
     * @var int|null
     * TODO: make conditional param serialisation
     */
    public ?int $order_id = null;

    /**
     * Overridden param
     * @var string
     * TODO: make conditional param serialisation
     */
    public string $pair = '';

    /**
     * @var string
     * TODO: make conditional param serialisation
     */
    public string $action = '';

    /**
     * @param array<array<Currency, Currency>> $currencyPairs
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function __construct(
        ?int $id = null,
        array $currencyPairs = [],
        Action $action = Action::None
    ) {
        parent::__construct($currencyPairs);

        // TODO: make allowed parameters combinations validation

        $this->setMethod(HttpMethod::Post);
        $this->setUri('/trade/orders_cancel');

        $this->order_id = $id;
        $this->action = $action->value;
    }
}
