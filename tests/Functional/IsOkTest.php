<?php

namespace Payeer\Tests\Functional;

use Payeer\Tests\Mocks\PayeerClientMock;

it('works properly', function () {
    $client = new PayeerClientMock('dummy_id', 'dummy_key');
    $client->setFake('{
  "success": true,
  "time": 13
}');
    $result = $client->isOk();

    expect($result->time)->toEqual(13);
})->group('functional');
