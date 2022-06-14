<?php

namespace Payeer\Responses\Models;

use Payeer\Enums\Currency;

/**
 * Balance response model element
 */
class Balance
{
    public Currency $currency;

    // TODO: work on the type of these params
    public float $total;
    public float $available;
    public float $hold;
}
