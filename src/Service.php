<?php

namespace Payeer;

use Payeer\Requests\RequestFactory;
use Payeer\Responses\ResponseBase;
use Payeer\Responses\ResponseFactory;

/**
 * API services operations
 */
class Service implements IService
{
    /**
     * @var ITransport payeer endpoint interaction object
     */
    private readonly ITransport $transport;

    public function __construct(string $url, string $id, string $sign)
    {
        $this->transport = $this->createTransport($url, $id, $sign);
    }

    /**
     * The magic method.
     * Instantiates corresponding Request and Response models.
     * Sends request to the Transport level.
     * @param $method
     * @param $args
     * @return ResponseBase
     * @throws \Exception
     */
    public function __call($method, $args): ResponseBase
    {
        try {
            // Instantiates a proper Request class
            $request = RequestFactory::create($method, $args);
        } catch (\Exception $ex) {
            // TODO: handle Service layer exceptions and convert them to user level one
            throw new \Exception('User exception...');
        }

        $result = $this->transport->send($request);

        try {
            // Instantiates a proper Response class
            // Auto maps properties
            $response = ResponseFactory::create($method, $result);
        } catch (\Exception $ex) {
            // TODO: handle Transport layer exceptions and convert them to user level one
            throw new \Exception('User exception...');
        }

        return $response;
    }

    /**
     * Helper function for testing.
     * Instantiates Transport object.
     * @param string $url
     * @param string $id
     * @param string $sign
     * @return Transport
     */
    protected function createTransport(string $url, string $id, string $sign): Transport
    {
        return new Transport($url, $id, $sign);
    }
}
