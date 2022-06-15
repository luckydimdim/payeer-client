<?php

namespace Payeer\Tests\Functional;

use Payeer\Enums\Currency;
use Payeer\Tests\Mocks\PayeerClientMock;

test('POST trades works properly', function () {
    $client = new PayeerClientMock('dummy_id', 'dummy_key');
    $client->setFake('{
  "success": true,
  "pairs": {
    "BTC_USD": [
      {
        "id": "14162760",
        "date": 1644327656,
        "type": "buy",
        "amount": "0.00060372",
        "price": "44299.99",
        "value": "26.75"
      },
      {
        "id": "14162734",
        "date": 1644327545,
        "type": "sell",
        "amount": "0.00000119",
        "price": "44399.98",
        "value": "0.06"
      }
    ],
    "BTC_RUB": [
      {
        "id": "14162750",
        "date": 1644327611,
        "type": "buy",
        "amount": "0.01152539",
        "price": "3230100.00",
        "value": "37228.16"
      },
      {
        "id": "14162749",
        "date": 1644327610,
        "type": "buy",
        "amount": "0.00988444",
        "price": "3230100.00",
        "value": "31927.73"
      }
    ]
  }
}');
    $result = $client->trades([
        [Currency::Btc, Currency::Usd],
        [Currency::Btc, Currency::Rub]
    ]);

    expect($result->data[0]->trades[1]->id)->toEqual(14162734);
    expect($result->data[1]->trades[0]->date)->toEqual(1644327611);
})->group('functional');


