<?php

use Payeer\Enums\Currency;
use Payeer\Requests\RatesRequest;

beforeEach(function () {
    $this->request = new RatesRequest();
});

afterEach(function () {
    $this->request = null;
});

test('getPairs can handle empty input', function () {
    expect($this->request->getPairs([]))->toBeEmpty();
})->group('requests');

test('getPairs parses enums to string properly', function () {
    expect($this->request->getPairs([
        [Currency::Btc, Currency::Usd]
    ]))->toEqual('BTC_USD');
})->group('requests');

test('getPairs parses multiple pairs correctly', function () {
    expect($this->request->getPairs([
        [Currency::Btc, Currency::Usd],
        [Currency::Btc, Currency::Rub]
    ]))->toEqual('BTC_USD,BTC_RUB');
})->group('requests');

test('validateParams handles incorrect number of elements in a pair', function () {
    $this->request->validateParams([Currency::Btc]);
})->throws('Incorrect parameters format.')->group('requests');

test('validateParams handles incorrect type of pair elements', function () {
    $this->request->validateParams([Currency::Btc, 'USD']);
})->throws('Incorrect parameters type.')->group('requests');

test('validateParams handles incorrect pair elements combinations', function () {
    $this->request->validateParams([Currency::Btc, Currency::Btc]);
})->throws('Incorrect parameters combination.')->group('requests');

