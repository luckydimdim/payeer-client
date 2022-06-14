<?php

namespace Payeer\Responses;

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
            // TODO: specify mapping Exception (trigger a user one here)
            throw new \Exception("Couldn't parse API response... ". $ex->getMessage());
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
            // TODO: specify Exception
            throw new \Exception("No handler found for API response $method.");
        }

        return $className;
    }
}
