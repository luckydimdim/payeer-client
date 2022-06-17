<?php

namespace Payeer\Tests\Functional;

use Payeer\Enums\Action;
use Payeer\Tests\Mocks\PayeerClientMock;

beforeEach(function () {
    $this->client = new PayeerClientMock('dummy_id', 'dummy_key');
});

afterEach(function () {
    $this->client = null;
});

test('order cancel by pairs and action works properly', function () {
    $this->client->setFake('{
  "success": true,
  "items": [
    "36987301",
    "36987294"
  ]
}');
    $result = $this->client->order->cancel(
        currencyPairs: [
            ["TRX", "RUB"],
            ["DOGE", "RUB"]
        ],
        action: Action::Buy);

    expect($result->success)->toBeTrue();
    expect($result->data[0])->toEqual(36987301);
})->group('functional');

test('order cancel by pairs works properly', function () {
    $this->client->setFake('{
  "success": true,
  "items": [
    "36987303",
    "36987294"
  ]
}');
    $result = $this->client->order->cancel(
        currencyPairs: [
            ["TRX", "RUB"],
            ["DOGE", "RUB"]
        ]);

    expect($result->success)->toBeTrue();
    expect($result->data[0])->toEqual(36987303);
})->group('functional');

test('cancel all orders works properly', function () {
    $this->client->setFake('{
  "success": true,
  "items": [
    "36987021",
    "36987015"
  ]
}');
    $result = $this->client->order->cancel();

    expect($result->success)->toBeTrue();
    expect($result->data[0])->toEqual(36987021);
})->group('functional');

