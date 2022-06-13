<?php

namespace Payeer\Enums;

/**
 * Possible actions with order
 */
enum Action: string
{
    case None = '';
    case Buy = 'buy';
    case Sell = 'sell';
}
