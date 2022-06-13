<?php

namespace Payeer\Requests;

/**
 * Crates instances of Request models
 */
class RequestFactory
{
    /**
     * Looks for a corresponding Request class and instantiates it
     * @param $method
     * @param $args
     * @return RequestBase
     * @throws \Exception
     */
    public static function create($method, $args): RequestBase
    {
        // TODO: validate $method param

        // Normalize
        $method = ucfirst($method);

        $className = '\Payeer\Requests\\' . $method . 'Request';

        print_r($className);

        if (class_exists($className)) {
            return new $className($args);
        }

        // TODO: specify Exception
        throw new \Exception("Requested service $method not found.");
    }
}
