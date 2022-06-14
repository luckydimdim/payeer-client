<?php

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

it('has time label and signature', function () {
    $request = $this->service->getRequest('rates', []);

    $this->transport->send($request);

    expect($this->transport->getClient()->options['json']['ts'] !== 0)->toBeTrue();
    expect($this->transport->getClient()->options['headers']['API-SIGN'] !== '')->toBeTrue();
})->group('transport');
