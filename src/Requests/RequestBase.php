<?php

namespace Payeer\Requests;

use Payeer\Enums\HttpMethod;
use Spatie\DataTransferObject\DataTransferObject;

/**
 * Base class for service layer requests
 */
abstract class RequestBase extends DataTransferObject
{
    public int $ts = 0;

    protected HttpMethod $method = HttpMethod::None;
    protected string $uri = '';

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function __construct(...$args)
    {
        parent::__construct($args);
    }

    /**
     * Sets request send time
     * @return void
     */
    public function setTime(): void
    {
        $this->ts = round(microtime(true) * 1000);
    }

    /**
     * HTTP method getter
     * @return HttpMethod
     */
    public function getMethod(): HttpMethod
    {
        return $this->method;
    }

    /**
     * HTTP method setter
     * @param HttpMethod $method
     * @return void
     */
    public function setMethod(HttpMethod $method): void
    {
        $this->method = $method;
    }

    /**
     * URI getter
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * URI setter
     * @param string $uri
     * @return void
     */
    public function setUri(string $uri): void
    {
        $this->uri = $uri;
    }

    /**
     * Serializes an object to JSON format
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->toArray(), JSON_PRETTY_PRINT);
    }
}
