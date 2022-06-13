<?php

namespace Payeer\Enums;

/**
 * HTTP methods
 */
enum HttpMethod: string
{
    case None = '';
    case Get = 'GET';
    case Post = 'POST';
}
