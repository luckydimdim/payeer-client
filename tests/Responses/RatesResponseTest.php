<?php

use Payeer\Enums\Currency;
use Payeer\Tests\Mocks\ServiceMock;

beforeEach(function () {
    $this->service = new ServiceMock('dummy_id', 'dummy_key', 'dummy_uri');
});

afterEach(function () {
    $this->service = null;
});

it('RatesResponse maps properly', function () {
    $serviceResponse = '{
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
      "min_price": "4332.68",
      "max_price": "82321.00",
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
    }
  }
}';
    $serviceResponse = json_decode($serviceResponse, true);

    $model = $this->service->getResponse('rates', $serviceResponse);

    expect($model->success)->toBeTrue();
    expect($model->limits[0]->limit)->toEqual(600);
    expect($model->limits[0]->intervalNumber)->toEqual(1);
    expect($model->data)->toHaveCount(2);
    expect($model->data[0]->currencyPair[0])->toEqual(Currency::Btc);
    expect($model->data[1]->maxPrice)->toEqual(6199117.08);
})->group('responses');
