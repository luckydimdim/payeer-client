<?php

use Payeer\Enums\Action;
use Payeer\Enums\HttpMethod;
use Payeer\Enums\Status;
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

test('ListRequest sent to my_orders API method', function () {
    $request = $this->service->getRequestModel('list', [
        Status::Opened,
        [["BTC", "RUB"]],
        Action::Buy
    ]);

    $this->transport->send($request);

    expect($this->transport->getClient()->method)->toEqual(HttpMethod::Post->value);
    expect($this->transport->getClient()->uri)->toEqual('/trade/my_orders');
    expect($this->transport->getClient()->options['json']['pair'])->toEqual('BTC_RUB');
    expect($this->transport->getClient()->options['json']['action'])->toEqual('buy');
})->group('requests');

test('ListRequest sent to my_history API method', function () {
    $request = $this->service->getRequestModel('list', [
        Status::Success,
        [["BTC", "RUB"]],
        Action::Buy,
        time()*1000-1000,
        time()*1000,
        111,
        3
    ]);

    $this->transport->send($request);

    expect($this->transport->getClient()->method)->toEqual(HttpMethod::Post->value);
    expect($this->transport->getClient()->uri)->toEqual('/trade/my_history');
    expect($this->transport->getClient()->options['json']['pair'])->toEqual('BTC_RUB');
    expect($this->transport->getClient()->options['json']['action'])->toEqual('buy');
})->group('requests');
