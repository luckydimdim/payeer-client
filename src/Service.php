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
     * @var ITransport payeer endpoint interaction object
     */
    protected readonly ITransport $transport;

    public function __construct(string $id, string $key, string $uri)
    {
        $this->transport = $this->createTransport($id, $key, $uri);
    }

    /**
     * The magic method.
     * Instantiates corresponding Request and Response models.
     * Sends request to the Transport level.
     * @param string $method
     * @param array $args
     * @return ResponseBase
     * @throws \Exception
     */
    public function __call(string $method, array $args): ResponseBase
    {
        $request = $this->getRequest($method, $args);

        try {
            $result = $this->transport->send($request);
        } catch (TransportException $ex) {
            throw new ApiErrorException($ex->getMessage());
        }

        $response = $this->getResponse($method, $result);
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
    protected function getRequest(string $method, array $args): RequestBase
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
    protected function getResponse(string $method, array $result): ResponseBase
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
     * Helper function for testing.
     * Instantiates Transport object.
     * @param string $id
     * @param string $key
     * @param string $uri
     * @return Transport
     */
    protected function createTransport(string $id, string $key, string $uri): Transport
    {
        return new Transport($id, $key, $uri);
    }
}
