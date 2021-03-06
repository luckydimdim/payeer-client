<?php

use Payeer\Enums\Action;
use Payeer\Enums\Type;
use Payeer\Tests\Mocks\ServiceMock;

beforeEach(function () {
    $this->service = new ServiceMock('dummy_id', 'dummy_key', 'dummy_uri');
});

afterEach(function () {
    $this->service = null;
});

test('CreateResponse maps properly', function () {
    $serviceResponse = '{
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
}';
    $serviceResponse = json_decode($serviceResponse, true);

    $model = $this->service->getResponseModel('create', $serviceResponse);

    expect($model->success)->toBeTrue();
    expect($model->id)->toEqual(37054386);
    expect($model->data->currencyPair)->toEqual(["TRX", "USD"]);
    expect($model->data->type)->toEqual(Type::Limit);
    expect($model->data->action)->toEqual(Action::Buy);
    expect($model->data->price)->toEqual(0.08000);
})->group('responses');
