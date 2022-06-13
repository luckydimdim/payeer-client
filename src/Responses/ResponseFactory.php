<?php

namespace Payeer\Responses;

/**
 * Crates instances of Response models
 */
class ResponseFactory
{
    /**
     * Looks for a corresponding Response class and instantiates it
     * @param $method
     * @param array $response
     * @return ResponseBase
     * @throws \Exception
     */
    public static function create($method, array $response): ResponseBase
    {
        // TODO: validate $method

        // Normalize
        $method = ucfirst($method);

        $className = '\Payeer\Responses\\' . $method . 'Response';

        if (class_exists($className)) {
            return new $className($response);
        }

        // TODO: specify Exception
        throw new \Exception('Requested service not found.');
    }
}
