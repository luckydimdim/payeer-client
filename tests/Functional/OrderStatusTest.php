<?php

namespace Payeer\Tests\Functional;

use Payeer\Enums\Status;
use Payeer\Tests\Mocks\PayeerClientMock;

test('order status works properly', function () {
        $client = new PayeerClientMock('dummy_id', 'dummy_key');
    $client->setFake('{
  "success": true,
  "order": {
    "id": "37054293",
    "date": 1644488809,
    "pair": "TRX_USD",
    "action": "buy",
    "type": "limit",
    "status": "success",
    "amount": "10.000000",
    "price": "0.08000",
    "value": "0.80",
    "amount_processed": "10.000000",
    "amount_remaining": "0.000000",
    "value_processed": "0.72",
    "value_remaining": "0.08",
    "avg_price": "0.07200",
    "trades": {
      "14190472": {
        "id": "14190472",
        "date": 1644488809,
        "status": "success",
        "price": "0.07150",
        "amount": "0.054165",
        "value": "0.01",
        "is_maker": false,
        "is_taker": true,
        "t_transaction_id": "1598693542"
      },
      "14190473": {
        "id": "14190473",
        "date": 1644488809,
        "status": "success",
        "price": "0.07165",
        "amount": "7.117935",
        "value": "0.51",
        "is_maker": false,
        "is_taker": true,
        "t_transaction_id": "1598693549"
      },
      "14190474": {
        "id": "14190474",
        "date": 1644488809,
        "status": "success",
        "price": "0.07200",
        "amount": "2.827900",
        "value": "0.20",
        "is_maker": false,
        "is_taker": true,
        "t_transaction_id": "1598693554"
      }
    }
  }
}');
    $result = $client->order->status(36942337);

    expect($result->data->valueProcessed)->toEqual(0.72);
    expect($result->data->trades)->toHaveCount(3);
    expect($result->data->trades[2]->status)->toEqual(Status::Success);
})->group('functional');


