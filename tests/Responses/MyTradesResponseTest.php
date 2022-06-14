<?php

use Payeer\Enums\Action;
use Payeer\Enums\Currency;
use Payeer\Tests\Mocks\ServiceMock;

beforeEach(function () {
    $this->service = new ServiceMock(uri: 'dummy', id: 'dummy');
});

afterEach(function () {
    $this->service = null;
});

it('MyTradesResponse maps properly', function () {
    $serviceResponse = '{
  "success": true,
  "items": {
    "14163029": {
      "id": "14163029",
      "date": 1644328859,
      "pair": "TRX_RUB",
      "action": "buy",
      "status": "success",
      "amount": "10.000000",
      "price": "5.10",
      "value": "51.00",
      "is_maker": false,
      "is_taker": true,
      "t_transaction_id": "1597309838"
    },
    "14175584": {
      "id": "14175584",
      "date": 1644400287,
      "pair": "TRX_USD",
      "action": "sell",
      "status": "success",
      "amount": "10.000000",
      "price": "0.06961",
      "value": "0.70",
      "is_maker": true,
      "is_taker": true,
      "m_transaction_id": "1597903047",
      "t_transaction_id": "1597903042"
    },
    "14175600": {
      "id": "14175600",
      "date": 1644400375,
      "pair": "TRX_USD",
      "action": "buy",
      "status": "success",
      "amount": "10.000000",
      "price": "0.06963",
      "value": "0.70",
      "is_maker": true,
      "is_taker": false,
      "m_transaction_id": "1597904047"
    }
  }
}';
    $serviceResponse = json_decode($serviceResponse, true);

    $model = $this->service->getResponse('myTrades', $serviceResponse);

    expect($model->success)->toBeTrue();
    expect($model->data)->toHaveCount(3);
    expect($model->data[0]->currencyPair[1])->toEqual(Currency::Rub);
    expect($model->data[1]->id)->toEqual(14175584);
    expect($model->data[2]->action)->toEqual(Action::Buy);
    expect($model->data[2]->makerTransactionId)->toEqual(1597904047);
})->group('responses');
