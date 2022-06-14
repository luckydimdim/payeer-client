<?php

namespace Payeer\Responses;

use Payeer\Exceptions\Service\ResponseCreationException;
use Payeer\Exceptions\Service\ResponseNotFoundException;

/**
 * Crates instances of Response models
 */
class ResponseFactory
{
    /**
     * Instantiates corresponding Response model
     * @param string $method
     * @param array $response
     * @return ResponseBase
     * @throws \Exception
     */
    public static function create(string $method, array $response): ResponseBase
    {
        // TODO: validate $method argument

        $className = self::getClassName($method);

        try {
            $instance = new $className($response);
        } catch (\Exception $ex) {
            throw new ResponseCreationException();
        }

        return $instance;
    }

    /**
     * Looks for a corresponding Response class
     * @param string $method
     * @return string
     * @throws \Exception
     */
    public static function getClassName(string $method): string
    {
        // Normalize
        $method = ucfirst($method);

        $className = '\Payeer\Responses\\' . $method . 'Response';

        if (!class_exists($className)) {
            throw new ResponseNotFoundException();
        }

        return $className;
    }
}
