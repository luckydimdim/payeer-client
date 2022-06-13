<?php

namespace Payeer\Tests\Mocks;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

/**
 * Guzzle Client mock
 */
class ClientMock extends Client
{
    public string $method = '';
    public string $uri = '';
    public array $options = [];

    public function request(string $method, $uri = '', array $options = []): ResponseInterface
    {
        $this->method = $method;
        $this->uri = $uri;
        $this->options = $options;

        return new Response();
    }
}
