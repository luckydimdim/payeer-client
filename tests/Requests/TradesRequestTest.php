<?php

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

it('TradesRequest accepts proper POST params from service layer', function () {
    $request = $this->service->getRequestModel('trades', [
        [["BTC", "RUB"]]
    ]);

    $this->transport->send($request);

    expect($this->transport->getClient()->method)->toEqual(HttpMethod::Post->value);
    expect($this->transport->getClient()->uri)->toEqual('/trade/trades');
    expect($this->transport->getClient()->options['json']['pair'])->toEqual('BTC_RUB');
})->group('requests');
