<?php

use Payeer\PayeerClient;
use Payeer\Tests\Mocks\PayeerClientMock;

it('compiles', function () {
    $client = new PayeerClient('dummy_id', 'dummy_key');
    expect($client)->toBeObject();
})->group('client');

it('can create mock services chain', function () {
    $client = new PayeerClientMock('dummy_id', 'dummy_key');

    expect($client->rates([
        ["BTC", "USD"]
    ]))->toBeObject();
})->group('client');;
