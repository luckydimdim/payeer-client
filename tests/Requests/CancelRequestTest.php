<?php

use Payeer\Enums\Action;
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

it('CancelRequest accepts proper POST params from service layer', function () {
    $request = $this->service->getRequestModel('cancel', [
        111,
        [["BTC", "USD"]],
        Action::Buy
    ]);

    $this->transport->send($request);

    expect($this->transport->getClient()->method)->toEqual(HttpMethod::Post->value);
    expect($this->transport->getClient()->uri)->toEqual('/trade/orders_cancel');
    expect($this->transport->getClient()->options['json']['pair'])->toEqual('BTC_USD');
    expect($this->transport->getClient()->options['json']['action'])->toEqual('buy');
})->group('requests');
