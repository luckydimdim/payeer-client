<?php

namespace Payeer\Responses;

/**
 * GetRates response model
 */
class RatesResponse extends ResponseBase
{
    public $limits;
    public $interval_num;
    public $limit;
    public $pairs;
}
