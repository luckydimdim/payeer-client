<?php

namespace Payeer\Tests\Mocks;

use GuzzleHttp\Client;
use Payeer\Requests\RequestBase;
use Payeer\Transport;

/**
 * Mock object for testing the transport layer
 */
class TransportMock extends Transport
{
    /**
     * Used for testing
     * @var array
     */
    public array $fake = [];

    public function send(RequestBase $request): array
    {
        // Set request send time label
        $request->setTime();

        // Signs request
        $requestMethod = $request->getMethod();
        $requestParams = $request->toArray();
        $sign = $this->getSign($requestMethod, $requestParams, $this->key);

        $response = $this->getClient()->request(
            $request->getMethod()->value,
            $request->getUri(),
            [
                'json' => $request->toArray(),
                'headers' => ['API-SIGN' => $sign]
            ]
        );

        return $this->fake;
    }

    protected function createClient(string $id, string $uri): Client
    {
        return new ClientMock([
            'base_uri' => $uri,
            'headers' => [
                'Accept' => 'application/json; charset=utf-8',
                'API-ID' => $id
            ]
        ]);
    }

    public function getClient(): Client
    {
        return $this->client;
    }
}
