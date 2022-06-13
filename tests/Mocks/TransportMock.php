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
    public function send(RequestBase $request): array
    {
        $response = $this->getClient()->request(
            $request->getMethod()->value,
            $request->getUri(),
            [
                'json' => $request->toArray()
            ]
        );

        return [];
    }

    protected function createClient(string $uri, string $id, string $sign): Client
    {
        return new ClientMock([
            'base_uri' => $uri,
            'headers' => [
                'Accept' => 'application/json; charset=utf-8',
                'API-ID' => $id,
                'API-SIGN' => $sign
            ]
        ]);
    }

    public function getClient(): Client
    {
        return $this->client;
    }
}
