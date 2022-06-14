<?php

namespace Payeer\Tests\Mocks;

use Payeer\PayeerClient;
use Payeer\Service;

/**
 * Mock object for testing the client api
 */
class PayeerClientMock extends PayeerClient
{
    public function setFake(string $json): void
    {
        $fake = [];
        if ($json) {
            $fake = json_decode($json, true);
        }

        $this->service->getTransport()->fake = $fake;
    }

    protected function createService(string $uri, string $id): Service
    {
        return new ServiceMock($uri, $id);
    }
}
