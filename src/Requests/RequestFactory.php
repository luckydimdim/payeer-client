<?php

namespace Payeer\Requests;

use Payeer\Exceptions\Service\RequestCreationException;
use Payeer\Exceptions\Service\RequestNotFoundException;

/**
 * Crates instances of Request models
 */
class RequestFactory
{
    /**
     * Looks for a corresponding Request class and instantiates it
     * @param string $method
     * @param array $args
     * @return RequestBase
     * @throws \Exception
     */
    public static function create(string $method, array $args): RequestBase
    {
        // TODO: validate $method param

        // Normalize
        $method = ucfirst($method);

        $className = self::getClassName($method);

        try {
            $class = new $className(...$args);
        } catch (\Spatie\DataTransferObject\Exceptions\UnknownProperties $ex) {
            throw new RequestCreationException($ex);
        }

        return $class;
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
            throw new RequestNotFoundException();
        }

        return $className;
    }
}
