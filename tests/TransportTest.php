<?php

use Payeer\Enums\Currency;
use Payeer\Requests\RatesRequest;
use Payeer\Responses\RatesResponse;
use Payeer\Tests\Mocks\ServiceMock;
use Payeer\Tests\Mocks\TransportMock;

beforeEach(function () {
    $this->service = new ServiceMock(uri: 'dummy', id: 'dummy', sign: 'dummy');
    $this->transport = new TransportMock(uri: 'dummy', id: 'dummy', sign: 'dummy');
});

afterEach(function () {
    $this->service = null;
    $this->transport = null;
});

it('accepts proper params from service layer', function () {
    $request = $this->service->getRequest('rates', [
        [Currency::Btc, Currency::Usd]
    ]);

    $this->transport->send($request);

    expect($this->transport->getClient()->method)->toEqual('GET');
    expect($this->transport->getClient()->uri)->toEqual('/trade/info');
    expect($this->transport->getClient()->options['json']['pair'])->toEqual('BTC_USD');
})->group('transport');
