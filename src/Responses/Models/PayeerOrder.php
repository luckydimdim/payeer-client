<?php

namespace Payeer\Responses\Models;

use Payeer\Enums\Action;
use Payeer\Enums\Status;
use Payeer\Enums\Type;

/**
 * PayeerOrder response model element
 */
class PayeerOrder
{
    public int $id;

    // TODO: work on the type of these params
    public int $date;

    public array $currencyPair;
    public Action $action;
    public Type $type;
    public Status $status = Status::None;

    // TODO: work on the type of these params
    public float $amount;
    public float $price;

    // Not used in Status method response
    public float $stopPrice = 0.0;
    public float $value;
    public float $amountProcessed;
    public float $amountRemaining;
    public float $valueProcessed;
    public float $valueRemaining;

    // Used only in Status method response
    public float $averagePrice = 0.0;

    // Not used in Status method response
    public bool $api;

    /**
     * Used only in Status method response
     * @var array<PayeerTrade>
     */
    public array $trades = [];
}
