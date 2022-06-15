<?php

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

it('has time label and signature', function () {
    $request = $this->service->getRequest('rates', []);

    $this->transport->send($request);

    expect($this->transport->getClient()->options['json']['ts'] !== 0)->toBeTrue();
    expect($this->transport->getClient()->options['headers']['API-SIGN'] !== '')->toBeTrue();
})->group('transport');
