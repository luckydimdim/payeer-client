<?php

use Payeer\Enums\Currency;
use Payeer\Enums\HttpMethod;
use Payeer\Tests\Mocks\ServiceMock;
use Payeer\Tests\Mocks\TransportMock;

beforeEach(function () {
    $this->service = new ServiceMock(uri: 'dummy', id: 'dummy');
    $this->transport = new TransportMock(uri: 'dummy', id: 'dummy');
});

afterEach(function () {
    $this->service = null;
    $this->transport = null;
});

it('accepts proper POST params from service layer', function () {
    $request = $this->service->getRequest('rates', [
        [Currency::Btc, Currency::Usd]
    ]);

    $this->transport->send($request);

    expect($this->transport->getClient()->method)->toEqual(HttpMethod::Post->value);
    expect($this->transport->getClient()->uri)->toEqual('/trade/info');
    expect($this->transport->getClient()->options['json']['pair'])->toEqual('BTC_USD');
})->group('transport');

it('accepts proper GET params from service layer', function () {
    $request = $this->service->getRequest('rates', []);

    $this->transport->send($request);

    expect($this->transport->getClient()->method)->toEqual(HttpMethod::Get->value);
    expect($this->transport->getClient()->uri)->toEqual('/trade/info');
    expect($this->transport->getClient()->options['json']['pair'])->toBeEmpty();
})->group('transport');

it('has time label and signature', function () {
    $request = $this->service->getRequest('rates', []);

    $this->transport->send($request);

    expect($this->transport->getClient()->options['json']['ts'] !== 0)->toBeTrue();
    expect($this->transport->getClient()->options['headers']['API-SIGN'] !== '')->toBeTrue();
})->group('transport');
