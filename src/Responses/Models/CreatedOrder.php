<?php

namespace Payeer\Responses\Models;

use Payeer\Enums\Action;
use Payeer\Enums\Type;

/**
 * Order create response model element
 */
class CreatedOrder
{
    public int $id;
    /**
     * @var array<string, string>
     */
    public array $currencyPair;

    public Type $type;
    public Action $action;

    // TODO: work on the type of these params
    public float $amount;
    public float $price;
    public float $value;
}
