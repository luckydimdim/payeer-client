<?php

namespace Payeer\Responses\Models;

/**
 * Order response model element
 */
class Order
{
    public array $currencyPair;

    // TODO: work on the type of these params
    public float $ask;
    public float $bid;

    public array $asks = [];
    public array $bids = [];
}
