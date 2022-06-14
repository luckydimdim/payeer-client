<?php

namespace Payeer\Tests\Functional;

use Cassandra\Uuid;
use Payeer\Enums\Action;
use Payeer\Enums\Currency;
use Payeer\Enums\Status;
use Payeer\Enums\Type;
use Payeer\Tests\Mocks\PayeerClientMock;

test('my orders list works properly', function () {
    $client = new PayeerClientMock(uri: 'dummy', id: 'dummy');
    $client->setFake('{
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
}');
    $result = $client->order->list(
        status: Status::Opened,
        currencyPairs: [
            [Currency::Btc, Currency::Usd],
            [Currency::Trx, Currency::Usd]
        ],
        action: Action::Buy);

    expect($result->data)->toHaveCount(6);
    expect($result->data[5]->id)->toEqual(36995144);
    expect($result->data[4]->value)->toEqual(0.50);
})->group('functional');

test('order all history works properly', function () {
    $client = new PayeerClientMock(uri: 'dummy', id: 'dummy');
    $client->setFake('{
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
}');
    $result = $client->order->list(pageSize: 3);

    expect($result->data)->toHaveCount(3);
    expect($result->data[2]->valueRemaining)->toEqual(1.00);
    expect($result->data[1]->type)->toEqual(Type::StopLimit);
})->group('functional');

test('order filtered history works properly', function () {
    $client = new PayeerClientMock(uri: 'dummy', id: 'dummy');
    $client->setFake('{
  "success": true,
  "items": {
    "28203919": {
      "id": "28203919",
      "date": 1631198637,
      "pair": "BTC_USD",
      "action": "buy",
      "type": "stop_limit",
      "status": "canceled",
      "amount": "0.00010000",
      "price": "47880.00",
      "value": "4.79",
      "amount_processed": "0.00000000",
      "amount_remaining": "0.00010000",
      "value_processed": "0.00",
      "value_remaining": "4.79",
      "stop_price": "60000.00"
    },
    "28252727": {
      "id": "28252727",
      "date": 1631274716,
      "pair": "BTC_USD",
      "action": "buy",
      "type": "limit",
      "status": "canceled",
      "amount": "0.00010000",
      "price": "10000.00",
      "value": "1.00",
      "amount_processed": "0.00000000",
      "amount_remaining": "0.00010000",
      "value_processed": "0.00",
      "value_remaining": "1.00"
    },
    "29032159": {
      "id": "29032159",
      "date": 1632483924,
      "pair": "BTC_USD",
      "action": "buy",
      "type": "stop_limit",
      "status": "canceled",
      "amount": "0.00010000",
      "price": "44717.16",
      "value": "4.48",
      "amount_processed": "0.00000000",
      "amount_remaining": "0.00010000",
      "value_processed": "0.00",
      "value_remaining": "4.48",
      "stop_price": "10000.00"
    }
  }
}');
    $result = $client->order->list(
        status: Status::Canceled,
        currencyPairs: [
            [Currency::Btc, Currency::Usd],
            [Currency::Btc, Currency::Rub]
        ],
        action: Action::Buy,
        dateFrom: 1630443600,
        dateTo: 1633035599,
        pageSize: 3);

    expect($result->data)->toHaveCount(3);
    expect($result->data[2]->stopPrice)->toEqual(10000.00);
    expect($result->data[1]->type)->toEqual(Type::Limit);
})->group('functional');


