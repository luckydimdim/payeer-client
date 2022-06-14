<?php

namespace Payeer;

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
    private readonly ITransport $transport;

    public function __construct(string $uri, string $id)
    {
        $this->transport = $this->createTransport($uri, $id);
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
        } catch (\Exception $ex) {
            // TODO: handle Transport layer exceptions and convert them to user level ones
            throw new \Exception('User exception... '. $ex->getMessage());
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
        } catch (\Exception $ex) {
            // TODO: handle Service layer exceptions and convert them to user level ones
            throw new \Exception('User exception... '. $ex->getMessage());
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
        } catch (\Exception $ex) {
            // TODO: handle Transport layer user exceptions and convert them to user level ones
            throw new \Exception('User exception... '. $ex->getMessage());
        }

        return $response;
    }

    /**
     * Helper function for testing.
     * Instantiates Transport object.
     * @param string $uri
     * @param string $id
     * @return Transport
     */
    protected function createTransport(string $uri, string $id): Transport
    {
        return new Transport($uri, $id);
    }
}
