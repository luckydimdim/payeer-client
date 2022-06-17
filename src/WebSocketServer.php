<?php

namespace Payeer;

use WebSocket\ConnectionException;

/**
 * WebSocket requests processor. Works in both directions:
 * 1. Forward: accepts JSON requests from client component and sends it to the API via WebSocket.
 * 2. Back: accepts responses from the API and sends it to a client component in JSON format.
 */
class WebSocketServer
{
    /**
     * @param string $id
     * @param string $key
     * @param string $uri
     */
    public function __construct(
        string $id,
        string $key,
        string $uri = 'wss://payeer.com/api/trade'
    ) {
        $this->service = new Service($id, $key, $uri);
    }

    /**
     * Runs WebSocket server and client in a loop
     * @return void
     * @throws \Exception
     */
    public function run(): void
    {
        $transport = $this->service->getTransport();

        while ($transport->openConnection()) {
            try {
                $requestJson = $transport->receiveFromClient();
                $request = json_decode($requestJson, true);

                // TODO: validate request format

                $methodName = $request['method'];
                $params = extract($request['params']);

                // Send request to Payeer API
                $this->service->$methodName($params);
            } catch (ConnectionException) {
            }

            try {
                // Get response from API
                $response = $transport->receiveFromApi();

                // TODO: validate response format

                $responseModel = $this->service->getResponseModel(
                    $response['method'], $response['payload']);

                // Send response to the client
                $transport->sendToClient($responseModel->toJson());
            } catch (ConnectionException) {
            }
        }

        $transport->closeConnection();
    }
}


