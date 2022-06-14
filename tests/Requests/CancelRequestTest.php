<?php

use Payeer\Enums\Action;
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

it('CancelRequest accepts proper POST params from service layer', function () {
    $request = $this->service->getRequest('cancel', [
        111,
        [[Currency::Btc, Currency::Usd]],
        Action::Buy
    ]);

    $this->transport->send($request);

    expect($this->transport->getClient()->method)->toEqual(HttpMethod::Post->value);
    expect($this->transport->getClient()->uri)->toEqual('/trade/orders_cancel');
    expect($this->transport->getClient()->options['json']['pair'])->toEqual('BTC_USD');
    expect($this->transport->getClient()->options['json']['action'])->toEqual('buy');
})->group('requests');
