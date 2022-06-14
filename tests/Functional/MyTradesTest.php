<?php

namespace Payeer\Tests\Functional;

use Payeer\Enums\Action;
use Payeer\Enums\Currency;
use Payeer\Tests\Mocks\PayeerClientMock;

test('POST all my trades works properly', function () {
    $client = new PayeerClientMock(uri: 'dummy', id: 'dummy');
    $client->setFake('{
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
}');
    $result = $client->myTrades(pageSize: 3);

    expect($result->data)->toHaveCount(3);
    expect($result->data[2]->makerTransactionId)->toEqual(1597904047);
    expect($result->data[2]->action)->toEqual(Action::Buy);
})->group('functional');

test('POST filtered my trades works properly', function () {
    $client = new PayeerClientMock(uri: 'dummy', id: 'dummy');
    $client->setFake('{
  "success": true,
  "items": {
    "12259786": {
      "id": "12259786",
      "date": 1632754083,
      "pair": "BTC_USD",
      "action": "buy",
      "status": "success",
      "amount": "0.00010000",
      "price": "44144.00",
      "value": "4.42",
      "is_maker": false,
      "is_taker": true,
      "t_transaction_id": "1505475255"
    },
    "12259796": {
      "id": "12259796",
      "date": 1632754158,
      "pair": "BTC_USD",
      "action": "buy",
      "status": "success",
      "amount": "0.00010000",
      "price": "44000.00",
      "value": "4.40",
      "is_maker": false,
      "is_taker": true,
      "t_transaction_id": "1505476013"
    },
    "12259915": {
      "id": "12259915",
      "date": 1632754502,
      "pair": "BTC_USD",
      "action": "buy",
      "status": "success",
      "amount": "0.00010000",
      "price": "44000.00",
      "value": "4.40",
      "is_maker": false,
      "is_taker": true,
      "t_transaction_id": "1505480022"
    }
  }
}');
    $result = $client->myTrades(
        currencyPairs: [
            [Currency::Btc, Currency::Usd],
            [Currency::Btc, Currency::Rub]
        ],
        action: Action::Buy,
        dateFrom: 1630443600,
        dateTo: 1633035599,
        pageSize: 3
    );

    expect($result->data)->toHaveCount(3);
    expect($result->data[1]->id)->toEqual(12259796);
    expect($result->data[1]->isMaker)->toBeFalse();
})->group('functional');


