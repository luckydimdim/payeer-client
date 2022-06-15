<?php

namespace Payeer\Tests\Functional;

use Payeer\Enums\Currency;
use Payeer\Tests\Mocks\PayeerClientMock;

test('POST balance works properly', function () {
    $client = new PayeerClientMock('dummy_id', 'dummy_key');
    $client->setFake('{
  "success": true,
  "balances": {
    "USD": {
      "total": 0.92,
      "available": 0.92,
      "hold": 0
    },
    "RUB": {
      "total": 1598.99,
      "available": 1548.99,
      "hold": 50
    },
    "EUR": {
      "total": 2.97,
      "available": 0,
      "hold": 2.97
    },
    "BTC": {
      "total": 0,
      "available": 0,
      "hold": 0
    },
    "ETH": {
      "total": 0,
      "available": 0,
      "hold": 0
    },
    "BCH": {
      "total": 0,
      "available": 0,
      "hold": 0
    },
    "LTC": {
      "total": 0,
      "available": 0,
      "hold": 0
    },
    "DASH": {
      "total": 0,
      "available": 0,
      "hold": 0
    },
    "USDT": {
      "total": 3,
      "available": 0,
      "hold": 3
    },
    "XRP": {
      "total": 0.9981,
      "available": 0.9981,
      "hold": 0
    },
    "DOGE": {
      "total": 94.55549964,
      "available": 94.55549964,
      "hold": 0
    },
    "TRX": {
      "total": 223.681806,
      "available": 208.681806,
      "hold": 15
    }
  }
}');
    $result = $client->balance();

    expect($result->data[0]->currency)->toEqual(Currency::Usd);
    expect($result->data[1]->available)->toEqual(1548.99);
})->group('functional');


