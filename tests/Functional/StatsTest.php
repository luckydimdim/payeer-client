<?php

namespace Payeer\Tests\Functional;

use Payeer\Enums\Currency;
use Payeer\Tests\Mocks\PayeerClientMock;

test('POST stats works properly', function () {
    $client = new PayeerClientMock('dummy_id', 'dummy_key');
    $client->setFake('{
  "success": true,
  "pairs": {
    "BTC_USD": {
      "ask": "43790.00",
      "bid": "43502.00",
      "last": "43501.00",
      "min24": "43006.01",
      "max24": "46000.00",
      "delta": "0.70",
      "delta_price": "301.00"
    },
    "BTC_RUB": {
      "ask": "3255999.99",
      "bid": "3238600.00",
      "last": "3230001.02",
      "min24": "3175000.00",
      "max24": "3390000.00",
      "delta": "1.57",
      "delta_price": "50001.02"
    }
  }
}');
    $result = $client->stats([
        [Currency::Btc, Currency::Usd],
        [Currency::Btc, Currency::Rub]
    ]);

    expect($result->data[0]->bid)->toEqual(43502.00);
    expect($result->data[1]->max24)->toEqual(3390000.00);
})->group('functional');


