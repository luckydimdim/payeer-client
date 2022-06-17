<?php

namespace Payeer;

use Payeer\Requests\RequestBase;

/**
 * Payeer endpoint interaction interface
 */
interface ITransport
{
    /*
     * Sends a request to Payeer API and receives a response
     */
    public function send(RequestBase $request): array;
}
