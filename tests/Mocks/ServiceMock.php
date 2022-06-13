<?php

namespace Payeer\Tests\Mocks;

use Payeer\Requests\RequestBase;
use Payeer\Responses\ResponseBase;
use Payeer\Service;
use Payeer\Transport;

/**
 * Mock object for testing the service layer
 */
class ServiceMock extends Service
{
    protected function createTransport(string $uri, string $id, string $sign): Transport
    {
        return new TransportMock($uri, $id, $sign);
    }

    public function getRequest(string $method, array $args): RequestBase
    {
        return parent::getRequest($method, $args);
    }

    public function getResponse(string $method, array $result): ResponseBase
    {
        return parent::getResponse($method, $result);
    }
}
