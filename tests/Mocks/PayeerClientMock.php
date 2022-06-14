<?php

namespace Payeer\Tests\Mocks;

use Payeer\PayeerClient;
use Payeer\Service;

/**
 * Mock object for testing the client api
 */
class PayeerClientMock extends PayeerClient
{
    protected function createService(string $uri, string $id): Service
    {
        return new ServiceMock($uri, $id);
    }
}
