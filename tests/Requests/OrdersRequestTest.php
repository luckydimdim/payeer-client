<?php

use Payeer\Enums\Currency;
use Payeer\Enums\HttpMethod;
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

it('OrdersRequest accepts proper POST params from service layer', function () {
    $request = $this->service->getRequest('orders', [
        [[Currency::Btc, Currency::Rub]]
    ]);

    $this->transport->send($request);

    expect($this->transport->getClient()->method)->toEqual(HttpMethod::Post->value);
    expect($this->transport->getClient()->uri)->toEqual('/trade/orders');
    expect($this->transport->getClient()->options['json']['pair'])->toEqual('BTC_RUB');
})->group('requests');
