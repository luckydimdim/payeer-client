<?php

use Payeer\Enums\Action;
use Payeer\Tests\Mocks\ServiceMock;

beforeEach(function () {
    $this->service = new ServiceMock('dummy_id', 'dummy_key', 'dummy_uri');
});

afterEach(function () {
    $this->service = null;
});

it('TradesResponse maps properly', function () {
    $serviceResponse = '{
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
}';
    $serviceResponse = json_decode($serviceResponse, true);

    $model = $this->service->getResponseModel('trades', $serviceResponse);

    expect($model->success)->toBeTrue();
    expect($model->data)->toHaveCount(2);
    expect($model->data[0]->currencyPair[1])->toEqual("USD");
    expect($model->data[1]->trades[0]->id)->toEqual(14162750);
    expect($model->data[1]->trades[0]->type)->toEqual(Action::Buy);
    expect($model->data[1]->trades[1]->date)->toEqual(1644327610);
})->group('responses');
