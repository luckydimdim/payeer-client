<?php

namespace Payeer\Responses\Models;

use Payeer\Enums\Action;
use Payeer\Enums\Currency;
use Payeer\Enums\Status;

/**
 * MyTrades response model element
 */
class MyTrade
{
    public int $id;

    // TODO: work on the type of these params
    public int $date;

    /**
     * @var array<Currency, Currency>
     */
    public array $currencyPair;

    public Action $action;
    public Status $status;

    // TODO: work on the type of these params
    public float $amount;
    public float $price;
    public float $value;

    public bool $isMaker;
    public bool $isTaker;
    public int $makerTransactionId;
    public int $takerTransactionId;
}
