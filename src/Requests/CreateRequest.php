<?php

namespace Payeer\Requests;

use Payeer\Enums\Action;
use Payeer\Enums\Currency;
use Payeer\Enums\Type;

/**
 * Order create request model
 */
class CreateRequest extends RatesRequest
{
    public string $type = '';
    public string $action = '';
    public string $amount = '';
    public string $price = '';

    /**
     * @param array<Currency, Currency> $currencyPairs
     * @param Type $type
     * @param Action $action
     * @param float $amount
     * @param float $price
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function __construct(
        array $currencyPairs,
        Type $type,
        Action $action,
        float $amount,
        float $price
    ) {
        parent::__construct($currencyPairs);

        $this->setUri('/trade/order_create');

        $this->type = $type->value;
        $this->action = $action->value;
        $this->amount = $amount;
        $this->price = $price;
    }
}
