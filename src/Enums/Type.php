<?php

namespace Payeer\Enums;

/**
 * Available order types
 */
enum Type: string
{
    case None = '';
    case Limit = 'limit';
    case Market = 'market';
    case StopLimit = 'stop_limit';
}
