<?php

use Payeer\Enums\Action;
use Payeer\Enums\Status;
use Payeer\Enums\Type;
use Payeer\Tests\Mocks\ServiceMock;

beforeEach(function () {
    $this->service = new ServiceMock('dummy_id', 'dummy_key', 'dummy_uri');
});

afterEach(function () {
    $this->service = null;
});

test('ListResponse maps my_orders properly', function () {
    $serviceResponse = '{
  "success": true,
  "items": {
    "36149941": {
      "id": "36149941",
      "date": 1643186519,
      "pair": "TRX_RUB",
      "action": "buy",
      "type": "stop_limit",
      "amount": "10.000000",
      "price": "5.00",
      "value": "50.00",
      "amount_processed": "0.000000",
      "amount_remaining": "10.000000",
      "value_processed": "0.00",
      "value_remaining": "50.00",
      "stop_price": "4.30"
    },
    "36150146": {
      "id": "36150146",
      "date": 1643186799,
      "pair": "TRX_RUB",
      "action": "sell",
      "type": "stop_limit",
      "amount": "15.000000",
      "price": "4.00",
      "value": "60.00",
      "amount_processed": "0.000000",
      "amount_remaining": "15.000000",
      "value_processed": "0.00",
      "value_remaining": "60.00",
      "stop_price": "4.00"
    },
    "36989287": {
      "id": "36989287",
      "date": 1644391218,
      "pair": "TRX_USD",
      "action": "buy",
      "type": "limit",
      "amount": "10.000000",
      "price": "0.05000",
      "value": "0.50",
      "amount_processed": "0.000000",
      "amount_remaining": "10.000000",
      "value_processed": "0.00",
      "value_remaining": "0.50"
    },
    "36989301": {
      "id": "36989301",
      "date": 1644391233,
      "pair": "TRX_USD",
      "action": "sell",
      "type": "limit",
      "amount": "10.000000",
      "price": "0.07000",
      "value": "0.70",
      "amount_processed": "0.000000",
      "amount_remaining": "10.000000",
      "value_processed": "0.00",
      "value_remaining": "0.70"
    },
    "36989322": {
      "id": "36989322",
      "date": 1644391269,
      "pair": "TRX_USD",
      "action": "buy",
      "type": "stop_limit",
      "amount": "10.000000",
      "price": "0.05000",
      "value": "0.50",
      "amount_processed": "0.000000",
      "amount_remaining": "10.000000",
      "value_processed": "0.00",
      "value_remaining": "0.50",
      "stop_price": "0.04000"
    },
    "36995144": {
      "id": "36995144",
      "date": 1644398632,
      "pair": "DASH_USD",
      "action": "buy",
      "type": "limit",
      "amount": "0.01000000",
      "price": "100.00",
      "value": "1.00",
      "amount_processed": "0.00000000",
      "amount_remaining": "0.01000000",
      "value_processed": "0.00",
      "value_remaining": "1.00"
    }
  }
}';
    $serviceResponse = json_decode($serviceResponse, true);

    $model = $this->service->getResponseModel('list', $serviceResponse);

    expect($model->success)->toBeTrue();
    expect($model->data)->toHaveCount(6);
    expect($model->data[5]->id)->toEqual(36995144);
    expect($model->data[5]->currencyPair[0])->toEqual("DASH");
    expect($model->data[5]->action)->toEqual(Action::Buy);
    expect($model->data[5]->status)->toEqual(Status::Opened);
    expect($model->data[5]->type)->toEqual(Type::Limit);
})->group('responses');

test('ListResponse maps my_history properly', function () {
    $serviceResponse = '{
  "success": true,
  "items": {
    "36989301": {
      "id": "36989301",
      "date": 1644391233,
      "pair": "TRX_USD",
      "action": "sell",
      "type": "limit",
      "status": "processing",
      "amount": "10.000000",
      "price": "0.07000",
      "value": "0.70",
      "amount_processed": "0.000000",
      "amount_remaining": "10.000000",
      "value_processed": "0.00",
      "value_remaining": "0.70"
    },
    "36989322": {
      "id": "36989322",
      "date": 1644391269,
      "pair": "TRX_USD",
      "action": "buy",
      "type": "stop_limit",
      "status": "processing",
      "amount": "10.000000",
      "price": "0.05000",
      "value": "0.50",
      "amount_processed": "0.000000",
      "amount_remaining": "10.000000",
      "value_processed": "0.00",
      "value_remaining": "0.50",
      "stop_price": "0.04000"
    },
    "36995144": {
      "id": "36995144",
      "date": 1644398632,
      "pair": "DASH_USD",
      "action": "buy",
      "type": "limit",
      "status": "processing",
      "amount": "0.01000000",
      "price": "100.00",
      "value": "1.00",
      "amount_processed": "0.00000000",
      "amount_remaining": "0.01000000",
      "value_processed": "0.00",
      "value_remaining": "1.00"
    }
  }
}';
    $serviceResponse = json_decode($serviceResponse, true);

    $model = $this->service->getResponseModel('list', $serviceResponse);

    expect($model->success)->toBeTrue();
    expect($model->data)->toHaveCount(3);
    expect($model->data[2]->id)->toEqual(36995144);
    expect($model->data[2]->currencyPair[0])->toEqual("DASH");
    expect($model->data[2]->action)->toEqual(Action::Buy);
    expect($model->data[2]->status)->toEqual(Status::Processing);
    expect($model->data[2]->type)->toEqual(Type::Limit);
})->group('responses');
