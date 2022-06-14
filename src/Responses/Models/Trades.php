<?php

namespace Payeer\Responses\Models;

use Payeer\Enums\Currency;

/**
 * Trade response model element
 */
class Trades
{
    /**
     * @var array<Currency, Currency>
     */
    public array $currencyPair;

    /**
     * @var array<Trade>
     */
    public array $trades;
}
