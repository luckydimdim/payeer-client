<?php

namespace Payeer\Enums;

/**
 * Possible order statuses
 */
enum Status: string
{
    case None = '';
    case Opened = 'opened';
    case Success = 'success';
    case Processing = 'processing';
    case Waiting = 'waiting';
    case Canceled = 'canceled';
}
