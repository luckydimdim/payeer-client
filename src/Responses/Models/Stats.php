<?php

namespace Payeer\Responses\Models;

/**
 * Stats response model element
 */
class Stats
{
    public array $currencyPair;

    // TODO: work on the type of these params
    public float $ask;
    public float $bid;
    public float $last;
    public float $min24;
    public float $max24;
    public float $delta;
    public float $deltaPrice;
}
