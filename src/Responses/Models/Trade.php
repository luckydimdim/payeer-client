<?php

namespace Payeer\Responses\Models;

use Payeer\Enums\Action;

/**
 * Trades response model element
 */
class Trade
{
    public int $id;

    // TODO: work on the type of these params
    public int $date;

    public Action $type;

    // TODO: work on the type of these params
    public float $amount;
    public float $price;
    public float $value;
}
