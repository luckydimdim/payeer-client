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
    public function getRequest(string $method, array $args): RequestBase
    {
        return parent::getRequest($method, $args);
    }

    public function getResponse(string $method, array $result): ResponseBase
    {
        return parent::getResponse($method, $result);
    }

    public function getTransport(): TransportMock
    {
        return $this->transport;
    }

    protected function createTransport(
        string $id,
        string $key,
        string $uri
    ): Transport {
        return new TransportMock($id, $key, $uri);
    }
}
