<?php

namespace Payeer\Responses\Models;

/**
 * Balance response model element
 */
class Balance
{
    public string $currency;

    // TODO: work on the type of these params
    public float $total;
    public float $available;
    public float $hold;
}
