<?php

use Payeer\Tests\Mocks\ServiceMock;

beforeEach(function () {
    $this->service = new ServiceMock('dummy_id', 'dummy_key', 'dummy_uri');
});

afterEach(function () {
    $this->service = null;
});

it('CancelResponse maps properly', function () {
    $serviceResponse = '{
  "success": true,
  "items": [
    "36987703",
    "36987698"
  ]
}';
    $serviceResponse = json_decode($serviceResponse, true);

    $model = $this->service->getResponseModel('cancel', $serviceResponse);

    expect($model->success)->toBeTrue();
    expect($model->data)->toHaveCount(2);
    expect($model->data[0])->toEqual(36987703);
    expect($model->data[1])->toEqual(36987698);
})->group('responses');
