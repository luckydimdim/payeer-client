<?php

namespace Payeer;

use GuzzleHttp\Client;
use Payeer\Enums\HttpMethod;
use Payeer\Exceptions\Transport\SendRequestException;
use Payeer\Exceptions\Transport\TransportException;
use Payeer\Requests\RequestBase;

/**
 * Payeer endpoint interaction class.
 * Converts request models to JSON.
 * Signs requests with timestamp and hash.
 * Executes JSON requests against Payeer API.
 * Returns responses in array format.
 * Handles transport layer errors.
 */
class Transport implements ITransport
{
    /**
     * @var Client HTTP client
     */
    protected Client $client;

    public function __construct(string $uri, protected readonly string $id)
    {
        $this->client = $this->createClient($uri, $this->id);
    }

    /**
     * Sends a request to Payeer API and receives a response
     * @param RequestBase $request
     * @return array
     * @throws SendRequestException
     * @throws TransportException
     */
    public function send(RequestBase $request): array
    {
        // Set request send time
        $request->setTime();

        // Get request signature
        $requestMethod = $request->getMethod();
        $requestParams = $request->toArray();
        $sign = $this->getSign($requestMethod, $requestParams, $this->id);

        try {
            $response = $this->client->request(
                $requestMethod->value,
                $request->getUri(),
                [
                    'json' => $requestParams,
                    // TODO: test that sign is correct
                    'headers' => ['API-SIGN' => $sign]
                ]);
        } catch (\GuzzleHttp\Exception\GuzzleException $ex) {
            throw new SendRequestException();
        } catch (\Exception $ex) {
            throw new TransportException();
        }

        // TODO: handle transformation exceptions
        $result = (array) json_decode((string) $response->getBody());

        return $result;
    }

    /**
     * Instantiates HTTP Client object. Function required for testing.
     * @param string $uri
     * @param string $id
     * @return Client
     */
    protected function createClient(string $uri, string $id): Client
    {
        return new Client([
            'base_uri' => $uri,
            'headers' => [
                'Accept' => 'application/json; charset=utf-8',
                'API-ID' => $id
            ]
        ]);
    }

    /**
     * Signs request with API KEY
     * @param HttpMethod $method
     * @param array $request
     * @param string $apiSecret
     * @return string
     * TODO: test this method
     */
    protected function getSign(
        HttpMethod $method, array $request, string $apiSecret
    ): string {
        return hash_hmac(
            'sha256',
            $method->value . json_encode($request),
            $apiSecret);
    }
}
