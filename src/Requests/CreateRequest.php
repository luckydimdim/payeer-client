<?php

namespace Payeer\Requests;

use Payeer\Enums\Action;
use Payeer\Enums\Type;

/**
 * Order create request model
 */
class CreateRequest extends RatesRequest
{
    public string $type = '';
    public string $action = '';
    public ?float $amount = null;
    public ?float $value = null;
    public ?float $stop_price = null;

    /**
     * @param array<string, string> $currencyPairs
     * @param Type $type
     * @param Action $action
     * @param float $amount
     * @param float $price
     * @param float|null $stopPrice
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function __construct(
        array $currencyPairs,
        Type $type,
        Action $action,
        float $amount,
        float $price,
        ?float $stopPrice
    ) {
        parent::__construct($currencyPairs);

        $this->setUri('/trade/order_create');

        $this->type = $type->value;
        $this->action = $action->value;

        // TODO: handle allowed params combinations for market type orders
        $this->amount = $amount;
        $this->value = $price;

        $this->stop_price = $stopPrice;
    }
}
