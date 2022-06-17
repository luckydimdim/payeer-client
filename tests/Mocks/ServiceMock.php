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
    public function getRequestModel(string $method, array $args): RequestBase
    {
        return parent::getRequestModel($method, $args);
    }

    public function getResponseModel(string $method, array $result): ResponseBase
    {
        return parent::getResponseModel($method, $result);
    }

    public function getTransport(): TransportMock
    {
        if (!$this->transport) {
            $this->transport = new TransportMock('dummy', 'dummy', 'dummy');
        }

        return $this->transport;
    }
}
