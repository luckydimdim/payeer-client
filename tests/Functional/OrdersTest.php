<?php

namespace Payeer\Tests\Functional;

use Payeer\Enums\Currency;
use Payeer\Tests\Mocks\PayeerClientMock;

test('POST orders works properly', function () {
    $client = new PayeerClientMock('dummy_id', 'dummy_key');
    $client->setFake('{
  "success": true,
  "pairs": {
    "BTC_USD": {
      "ask": "43790.00",
      "bid": "43520.00",
      "asks": [
        {
          "price": "43790.00",
          "amount": "0.00031422",
          "value": "13.76"
        },
        {
          "price": "43800.00",
          "amount": "0.00125530",
          "value": "54.99"
        }
      ],
      "bids": [
        {
          "price": "43520.00",
          "amount": "0.00034788",
          "value": "15.13"
        },
        {
          "price": "43502.00",
          "amount": "0.04065736",
          "value": "1768.67"
        }
      ]
    },
    "BTC_RUB": {
      "ask": "3255999.99",
      "bid": "3238600.00",
      "asks": [
        {
          "price": "3255999.99",
          "amount": "0.00010000",
          "value": "325.60"
        }
      ],
      "bids": [
        {
          "price": "3238600.00",
          "amount": "0.00022212",
          "value": "719.35"
        },
        {
          "price": "3230001.02",
          "amount": "0.00083607",
          "value": "2700.50"
        }
      ]
    }
  }
}');
    $result = $client->orders([
        [Currency::Btc, Currency::Usd],
        [Currency::Btc, Currency::Rub]
    ]);

    expect($result->data)->toHaveCount(2);
    expect($result->data[1]->ask)->toEqual(3255999.99);
    expect($result->data[1]->asks[0]->price)->toEqual(3255999.99);
    expect($result->data[1]->bids[1]->amount)->toEqual(0.00083607);
})->group('functional');


