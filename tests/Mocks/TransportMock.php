<?php

namespace Payeer\Tests\Mocks;

use Payeer\Requests\RequestBase;
use Payeer\Transport;

/**
 * Mock object for testing the transport layer
 */
class TransportMock extends Transport
{
    public function send(RequestBase $request): array
    {
        return [];
    }
}
