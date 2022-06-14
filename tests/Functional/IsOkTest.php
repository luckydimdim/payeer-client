<?php

namespace Payeer\Tests\Functional;

use Payeer\Tests\Mocks\PayeerClientMock;

it('works properly', function () {
    $client = new PayeerClientMock(uri: 'dummy', id: 'dummy');
    $client->setFake('{
  "success": true,
  "time": 13
}');
    $result = $client->isOk();

    expect($result->time)->toEqual(13);
})->group('functional');


