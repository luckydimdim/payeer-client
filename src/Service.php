<?php

namespace Payeer;

use Payeer\Exceptions\Service\ApiErrorException;
use Payeer\Exceptions\Service\ServiceException;
use Payeer\Exceptions\Transport\TransportException;
use Payeer\Requests\RequestBase;
use Payeer\Requests\RequestFactory;
use Payeer\Responses\ResponseBase;
use Payeer\Responses\ResponseFactory;

/**
 * API services operations.
 * Instantiates and fills request models with user parameters
 * and pass them to transport layer.
 * Handles transport layer responses and maps them to corresponding response models.
 * Calls API errors handler.
 */
class Service implements IService
{
    /**
     * @var ITransport|null payeer endpoint interaction object
     */
    protected ?ITransport $transport = null;

    /**
     * If response is required on the caller's side
     * @var bool
     */
    private bool $enableResponse = true;

    public function __construct(
        private readonly string $id,
        private readonly string $key,
        private readonly string $uri
    ) {
        $this->transport = $this->getTransport();
    }

    /**
     * The magic method.
     * Instantiates corresponding Request and Response models.
     * Sends request to the Transport level.
     * @param string $method
     * @param array $args
     * @return ResponseBase|null
     * @throws ApiErrorException
     */
    public function __call(string $method, array $args): ?ResponseBase
    {
        $request = $this->getRequestModel($method, $args);

        try {
            $result = $this->transport->send($request);
        } catch (TransportException $ex) {
            throw new ApiErrorException($ex->getMessage());
        }

        // Response is not required
        if (!$this->enableResponse) {
            return null;
        }

        $response = $this->getResponseModel($method, $result);
        $response->handleApiErrors();

        return $response;
    }

    /**
     * Looks for corresponding Request and instantiates it
     * @param string $method
     * @param array $args
     * @return RequestBase
     * @throws \Exception
     */
    protected function getRequestModel(string $method, array $args): RequestBase
    {
        try {
            // Instantiates a proper Request class
            $request = RequestFactory::create($method, $args);
        } catch (ServiceException $ex) {
            throw $ex;
        }

        return $request;
    }

    /**
     * Finds corresponding Response and instantiates it
     * @param string $method
     * @param array $result
     * @return ResponseBase
     * @throws \Exception
     */
    public function getResponseModel(string $method, array $result): ResponseBase
    {
        try {
            // Instantiates a proper Response class
            // Auto maps properties
            $response = ResponseFactory::create($method, $result);
        } catch (ServiceException $ex) {
            throw $ex;
        }

        return $response;
    }

    /**
     * Instantiates Transport object.
     * @return Transport
     */
    public function getTransport(): ITransport
    {
        // Returns transport instantiated earlier
        if ($this->transport) {
            return $this->transport;
        }

        $uriParts = parse_url($this->uri);

        // Instantiate corresponding Transport class
        if (in_array($uriParts['scheme'], ['ws', 'wss'])) {
            // WebSocket doesn't respond after request,
            // so we don't need to handle responses
            $this->enableResponse = false;

            return new WebSocketTransport($this->id, $this->key, $this->uri);
        } else {
            return new Transport($this->id, $this->key, $this->uri);
        }
    }
}
