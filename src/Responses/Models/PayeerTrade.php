<?php

namespace Payeer\Responses\Models;

use Payeer\Enums\Status;

/**
 * PayeerOrder response trades param model element
 */
class PayeerTrade
{
    public int $id;

    // TODO: work on the type of these params
    public int $date;

    public Status $status;

    // TODO: work on the type of these params
    public float $price;
    public float $amount;
    public float $value;

    public bool $isMaker;
    public bool $isTaker;
    public int $transactionId;
}
