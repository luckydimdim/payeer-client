<?php

use Payeer\Enums\Action;
use Payeer\Enums\Currency;
use Payeer\Enums\HttpMethod;
use Payeer\Enums\Type;
use Payeer\Tests\Mocks\ServiceMock;
use Payeer\Tests\Mocks\TransportMock;

beforeEach(function () {
    $this->service = new ServiceMock('dummy_id', 'dummy_key', 'dummy_uri');
    $this->transport = new TransportMock('dummy_id', 'dummy_key', 'dummy_uri');
});

afterEach(function () {
    $this->service = null;
    $this->transport = null;
});

test('CreateRequest accepts proper POST params from service layer', function () {
    $request = $this->service->getRequest('create', [
        [[Currency::Btc, Currency::Usd]],
        Type::Limit,
        Action::Buy,
        3,
        50,
        0
    ]);

    $this->transport->send($request);

    expect($this->transport->getClient()->method)->toEqual(HttpMethod::Post->value);
    expect($this->transport->getClient()->uri)->toEqual('/trade/order_create');
    expect($this->transport->getClient()->options['json']['pair'])->toEqual('BTC_USD');
    expect($this->transport->getClient()->options['json']['action'])->toEqual('buy');
    expect($this->transport->getClient()->options['json']['type'])->toEqual('limit');
})->group('requests');
