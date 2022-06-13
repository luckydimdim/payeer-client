<?php

namespace Payeer\Requests;

use Payeer\Enums\HttpMethod;
use Spatie\DataTransferObject\DataTransferObject;

/**
 * Base class for service layer requests
 */
abstract class RequestBase extends DataTransferObject
{
    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function __construct(
        protected readonly HttpMethod $method,
        protected readonly string $uri,
        ...$args
    ) {
        parent::__construct($args);
    }

    /**
     * Method getter
     * @return HttpMethod
     */
    public function getMethod(): HttpMethod
    {
        return $this->method;
    }

    /**
     * URI getter
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }
}
