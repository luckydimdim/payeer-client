<?php

namespace Payeer\Responses\Models;

/**
 * Trade response model element
 */
class Trades
{
    /**
     * @var array<string, string>
     */
    public array $currencyPair;

    /**
     * @var array<Trade>
     */
    public array $trades;
}
