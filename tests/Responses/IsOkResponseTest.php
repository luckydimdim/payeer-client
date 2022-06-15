<?php

use Payeer\Tests\Mocks\ServiceMock;

beforeEach(function () {
    $this->service = new ServiceMock('dummy_id', 'dummy_key', 'dummy_uri');
});

afterEach(function () {
    $this->service = null;
});

it('IsOk response exposes properly filled model', function () {
    $serviceResponse = '{
  "success": true,
  "time": 1644322909335
}';
    $serviceResponse = json_decode($serviceResponse, true);

    $model = $this->service->getResponse('isOk', $serviceResponse);

    expect($model->success)->toBeTrue();
    expect($model->time !== 0)->toBeTrue();
})->group('responses');
