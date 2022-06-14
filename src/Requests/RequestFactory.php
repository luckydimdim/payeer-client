<?php

namespace Payeer\Requests;

/**
 * Crates instances of Request models
 */
class RequestFactory
{
    /**
     * Looks for a corresponding Request class and instantiates it
     * @param string $method
     * @param $args
     * @return RequestBase
     * @throws \Exception
     */
    public static function create(string $method, $args): RequestBase
    {
        // TODO: validate $method param

        // Normalize
        $method = ucfirst($method);

        $className = self::getClassName($method);

        return new $className($args);
    }

    /**
     * Looks for a corresponding Request class
     * @param string $method
     * @return string
     * @throws \Exception
     */
    public static function getClassName(string $method): string
    {
        // Normalize
        $method = ucfirst($method);

        $className = '\Payeer\Requests\\' . $method . 'Request';

        if (!class_exists($className)) {
            // TODO: specify Exception
            throw new \Exception('Requested service not found.');
        }

        return $className;
    }
}
