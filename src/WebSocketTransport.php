<?php

namespace Payeer;


use Payeer\Exceptions\Transport\TransportException;
use Payeer\Requests\RequestBase;
use WebSocket\Client;
use WebSocket\Server;

/**
 * Serves communication between this package and Payeer API
 * and between end user and this package.
 */
class WebSocketTransport implements ITransport
{
    private readonly Server $server;
    private readonly Client $client;

    public function __construct(
        string $id,
        private readonly string $key,
        string $uri
    ) {
        $this->server = new Server();
        $this->client = new Client($uri, [
            'headers' => [
                'API-ID' => $id
            ]
        ]);
    }

    /**
     * Sends a request to Payeer API
     * @param RequestBase $request
     * @return array
     * @throws \WebSocket\BadOpcodeException
     */
    public function send(RequestBase $request): array
    {
        // Set request send time
        $request->setTime();

        $requestParams = $request->toJson();
        $sign = $this->getSign($requestParams, $this->key);

        // Compose the request string
        $payload = $this->getRequestString($requestParams, $sign);

        // TODO: handle exceptions
        $this->client->send($payload);

        return [];
    }

    /**
     * Accepts connection with a client
     * @return bool
     */
    public function openConnection(): bool
    {
        return $this->server->accept();
    }

    /**
     * Sends responses to a caller client
     * @param string $payload
     * @param string $opcode
     * @param bool $masked
     * @return void
     * @throws \WebSocket\BadOpcodeException
     */
    public function sendToClient(
        string $payload,
        string $opcode = 'text',
        bool $masked = true
    ): void {
        $this->server->send($payload, $opcode, $masked);
    }

    /**
     * Receives requests from a client
     */
    public function receiveFromClient()
    {
        $this->server->receive();
    }

    /**
     * Receives responses from Payeer API
     */
    public function receiveFromApi(): array
    {
        $responseJson = $this->client->receive();
        $response = json_decode($responseJson, true);

        return $response;
    }

    /**
     * Tells sockets to close
     * @return void
     */
    public function closeConnection(): void
    {
        $this->server->close();
        $this->client->close();
    }

    /**
     * Inserts sign to the request and returns JSON string
     * @param $payload
     * @param $sign
     * @return string
     */
    private function getRequestString($payload, $sign): string
    {
        $result = '
        {
            "payload": ' . $payload . ',
            "sign": ' . $sign . '
        }';

        return $result;
    }

    /**
     * Signs request body with the API KEY
     * @param string $requestJson
     * @param string $apiSecret
     * @return string
     */
    private function getSign(
        string $requestJson,
        string $apiSecret
    ): string {
        return hash_hmac('sha256', $requestJson, $apiSecret);
    }
}
