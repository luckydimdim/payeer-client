<?php

use Payeer\Enums\Currency;
use Payeer\Tests\Mocks\ServiceMock;

beforeEach(function () {
    $this->service = new ServiceMock('dummy_id', 'dummy_key', 'dummy_uri');
});

afterEach(function () {
    $this->service = null;
});

it('StatsResponse maps properly', function () {
    $serviceResponse = '{
  "success": true,
  "pairs": {
    "BTC_USD": {
      "ask": "43555.55",
      "bid": "43506.01",
      "last": "43555.55",
      "min24": "43006.01",
      "max24": "46000.00",
      "delta": "1.06",
      "delta_price": "455.55"
    },
    "BTC_RUB": {
      "ask": "3258999.99",
      "bid": "3230001.02",
      "last": "3230001.00",
      "min24": "3175000.00",
      "max24": "3390000.00",
      "delta": "1.41",
      "delta_price": "45000.97"
    },
    "BTC_EUR": {
      "ask": "40000.00",
      "bid": "39000.00",
      "last": "40100.00",
      "min24": "37560.00",
      "max24": "40100.00",
      "delta": "6.79",
      "delta_price": "2549.00"
    }
  }
}';
    $serviceResponse = json_decode($serviceResponse, true);

    $model = $this->service->getResponse('stats', $serviceResponse);

    expect($model->success)->toBeTrue();
    expect($model->data)->toHaveCount(3);
    expect($model->data[0]->currencyPair[1])->toEqual(Currency::Usd);
    expect($model->data[1]->max24)->toEqual(3390000.00);
})->group('responses');
