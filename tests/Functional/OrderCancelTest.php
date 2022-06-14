<?php

namespace Payeer\Tests\Functional;

use Payeer\Enums\Action;
use Payeer\Enums\Currency;
use Payeer\Enums\Status;
use Payeer\Enums\Type;
use Payeer\Tests\Mocks\PayeerClientMock;

test('order cancel by pairs and action works properly', function () {
    $client = new PayeerClientMock(uri: 'dummy', id: 'dummy');
    $client->setFake('{
  "success": true,
  "items": [
    "36987301",
    "36987294"
  ]
}');
    $result = $client->order->cancel(
        currencyPairs: [
            [Currency::Trx, Currency::Rub],
            [Currency::Doge, Currency::Rub]
        ],
        action: Action::Buy);

    expect($result->success)->toBeTrue();
    expect($result->data[0])->toEqual(36987301);
})->group('functional');

test('order cancel by pairs works properly', function () {
    $client = new PayeerClientMock(uri: 'dummy', id: 'dummy');
    $client->setFake('{
  "success": true,
  "items": [
    "36987303",
    "36987294"
  ]
}');
    $result = $client->order->cancel(
        currencyPairs: [
            [Currency::Trx, Currency::Rub],
            [Currency::Doge, Currency::Rub]
        ]);

    expect($result->success)->toBeTrue();
    expect($result->data[0])->toEqual(36987303);
})->group('functional');

test('cancel all orders works properly', function () {
    $client = new PayeerClientMock(uri: 'dummy', id: 'dummy');
    $client->setFake('{
  "success": true,
  "items": [
    "36987021",
    "36987015"
  ]
}');
    $result = $client->order->cancel();

    expect($result->success)->toBeTrue();
    expect($result->data[0])->toEqual(36987021);
})->group('functional');

