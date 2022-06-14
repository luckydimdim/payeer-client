<?php

use Payeer\Enums\Currency;
use Payeer\PayeerClient;
use Payeer\Tests\Mocks\PayeerClientMock;

it('compiles', function () {
    $client = new PayeerClient(uri: 'dummy', id: 'dummy');
    expect($client)->toBeObject();
})->group('client');

it('can create mock services chain', function () {
    $client = new PayeerClientMock('dummy', 'dummy');

    expect($client->rates([
        [Currency::Btc, Currency::Usd]
    ]))->toBeObject();
})->group('client');;
