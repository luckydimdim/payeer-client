<?php

namespace Payeer\Tests\Functional;

use Payeer\Enums\Action;
use Payeer\Enums\Type;
use Payeer\Tests\Mocks\PayeerClientMock;

test('order creates properly', function () {
    $client = new PayeerClientMock('dummy_id', 'dummy_key');
    $client->setFake('{
  "success": true,
  "order_id": 37054386,
  "params": {
    "pair": "TRX_USD",
    "type": "limit",
    "action": "buy",
    "amount": "10.000000",
    "price": "0.08000",
    "value": "0.80"
  }
}');
    $result = $client->order->create(
        currencyPairs: [["TRX", "USD"]],
        type: Type::Limit,
        action: Action::Buy,
        amount: 10,
        price: 0.08);

    expect($result->success)->toBeTrue();
    expect($result->id)->toEqual(37054386);
    expect($result->data->type)->toEqual(Type::Limit);
})->group('functional');


