<?php

namespace Payeer\Responses\Models;

/**
 * Rates response model element
 */
class Rate
{
    public array $currencyPair;
    public int $pricePrecision;

    // TODO: work on the type of these params
    public float $minPrice;
    public float $maxPrice;
    public float $minAmount;
    public float $minValue;
    public float $feeMakerPercent;
    public float $feeTakerPercent;
}
