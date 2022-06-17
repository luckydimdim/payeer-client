<?php

namespace Payeer\Tests\Functional;

use Payeer\Tests\Mocks\PayeerClientMock;

test('GET all rates works properly', function () {
    $client = new PayeerClientMock('dummy_id', 'dummy_key');
    $client->setFake('{
  "success": true,
  "limits": {
    "requests": [
      {
        "interval": "min",
        "interval_num": 1,
        "limit": 600
      }
    ]
  },
  "pairs": {
    "BTC_USD": {
      "price_prec": 2,
      "min_price": "4375.74",
      "max_price": "83139.00",
      "min_amount": 0.0001,
      "min_value": 0.5,
      "fee_maker_percent": 0.01,
      "fee_taker_percent": 0.095
    },
    "BTC_RUB": {
      "price_prec": 2,
      "min_price": "326269.32",
      "max_price": "6199117.08",
      "min_amount": 0.0001,
      "min_value": 20,
      "fee_maker_percent": 0.01,
      "fee_taker_percent": 0.095
    },
    "BTC_EUR": {
      "price_prec": 2,
      "min_price": "3798.60",
      "max_price": "72173.39",
      "min_amount": 0.0001,
      "min_value": 0.5,
      "fee_maker_percent": 0.01,
      "fee_taker_percent": 0.095
    }
  }
}');
    $result = $client->rates();

    expect($result->limits[0]->limit)->toEqual(600);
    expect($result->data[0]->currencyPair)->toEqual(["BTC", "USD"]);
    expect($result->data[2]->maxPrice)->toEqual(72173.39);
})->group('functional');


