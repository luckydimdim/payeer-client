<?php

use Payeer\Requests\RatesRequest;
use Payeer\Responses\RatesResponse;
use Payeer\Tests\Mocks\ServiceMock;

beforeEach(function () {
    $this->service = new ServiceMock('dummy_id', 'dummy_key', 'dummy_uri');
});

afterEach(function () {
    $this->service = null;
});

it('instantiates proper request model', function () {
    $result = $this->service->getRequestModel('rates', [
        [["BTC", "USD"]]
    ]);
    expect($result)->toBeInstanceOf(RatesRequest::class);
})->group('service');

it('instantiates proper response model', function () {
    $result = $this->service->getResponseModel('rates', []);
    expect($result)->toBeInstanceOf(RatesResponse::class);
})->group('service');
