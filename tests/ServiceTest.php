<?php

use Payeer\Enums\Currency;
use Payeer\Requests\RatesRequest;
use Payeer\Responses\RatesResponse;
use Payeer\Tests\Mocks\ServiceMock;

beforeEach(function () {
    $this->service = new ServiceMock(uri: 'dummy', id: 'dummy', sign: 'dummy');
});

afterEach(function () {
    $this->service = null;
});

it('instantiates proper request model', function () {
    $result = $this->service->getRequest('rates', [
        [Currency::Btc, Currency::Usd]
    ]);
    expect($result)->toBeInstanceOf(RatesRequest::class);
})->group('service');

it('instantiates proper response model', function () {
    $result = $this->service->getResponse('rates', []);
    expect($result)->toBeInstanceOf(RatesResponse::class);
})->group('service');
