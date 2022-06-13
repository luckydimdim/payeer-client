<?php

namespace Payeer;

use GuzzleHttp\Client;
use Payeer\Requests\RequestBase;

/**
 * Payeer endpoint interaction class.
 * Converts Request objects to JSON, executes JSON requests against Payeer API,
 * returns responses in array format, handles transport level errors.
 */
class Transport implements ITransport
{
    /**
     * @var Client HTTP client
     */
    protected Client $client;

    public function __construct(string $uri, string $id, string $sign)
    {
        $this->client = $this->createClient($uri, $id, $sign);
    }

    /**
     * Sends a request to Payeer API and receives a response
     * @param RequestBase $request
     * @return array
     */
    public function send(RequestBase $request): array
    {
        try {
            $response = $this->client->request(
                $request->getMethod()->value,
                $request->getUri(),
                [
                    'json' => $request->toArray()
                ]);
        } catch (\GuzzleHttp\Exception\GuzzleException $ex) {
            // TODO: handle exception
        } catch (\Exception $ex) {
            // TODO: handle other network related exceptions
        }

        // TODO: handle transformation exceptions
        $result = (array) json_decode((string) $response->getBody());

        return $result;
    }

    /**
     * Instantiates HTTP Client object. Function required for testing.
     * @param string $uri
     * @param string $id
     * @param string $sign
     * @return Client
     */
    protected function createClient(string $uri, string $id, string $sign): Client
    {
        return new Client([
            'base_uri' => $uri,
            'headers' => [
                'Accept' => 'application/json; charset=utf-8',
                'API-ID' => $id,
                'API-SIGN' => $sign
            ]
        ]);
    }
}
