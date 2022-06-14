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

it('MyTradesRequest accepts proper POST params from service layer', function () {
    $request = $this->service->getRequest('myTrades', [
        [[Currency::Btc, Currency::Rub]],
        Action::Buy,
        time()*1000-1000,
        time()*1000,
        0,
        3
    ]);

    $this->transport->send($request);

    expect($this->transport->getClient()->method)->toEqual(HttpMethod::Post->value);
    expect($this->transport->getClient()->uri)->toEqual('/trade/my_trades');
    expect($this->transport->getClient()->options['json']['pair'])->toEqual('BTC_RUB');
})->group('requests');
