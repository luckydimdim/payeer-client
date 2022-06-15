<?php

use Payeer\Enums\Currency;
use Payeer\Tests\Mocks\ServiceMock;

beforeEach(function () {
    $this->service = new ServiceMock('dummy_id', 'dummy_key', 'dummy_uri');
});

afterEach(function () {
    $this->service = null;
});

it('BalanceResponse maps properly', function () {
    $serviceResponse = '{
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
}';
    $serviceResponse = json_decode($serviceResponse, true);

    $model = $this->service->getResponse('balance', $serviceResponse);

    expect($model->success)->toBeTrue();
    expect($model->data)->toHaveCount(12);
    expect($model->data[11]->currency)->toEqual(Currency::Trx);
    expect($model->data[10]->available)->toEqual(94.55549964);
})->group('responses');
