<?php

use Payeer\Enums\Currency;
use Payeer\Enums\HttpMethod;
use Payeer\Requests\RatesRequest;
use Payeer\Tests\Mocks\ServiceMock;
use Payeer\Tests\Mocks\TransportMock;

beforeEach(function () {
    $this->service = new ServiceMock(uri: 'dummy', id: 'dummy');
    $this->transport = new TransportMock(uri: 'dummy', id: 'dummy');
    $this->request = new RatesRequest();
});

afterEach(function () {
    $this->service = null;
    $this->transport = null;
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

it('RatesRequest accepts proper POST params from service layer', function () {
    $request = $this->service->getRequest('rates', [
        [[Currency::Btc, Currency::Usd]]
    ]);

    $this->transport->send($request);

    expect($this->transport->getClient()->method)->toEqual(HttpMethod::Post->value);
    expect($this->transport->getClient()->uri)->toEqual('/trade/info');
    expect($this->transport->getClient()->options['json']['pair'])->toEqual('BTC_USD');
})->group('requests');

it('RatesRequest accepts proper GET params from service layer', function () {
    $request = $this->service->getRequest('rates', []);

    $this->transport->send($request);

    expect($this->transport->getClient()->method)->toEqual(HttpMethod::Get->value);
    expect($this->transport->getClient()->uri)->toEqual('/trade/info');
    expect($this->transport->getClient()->options['json']['pair'])->toBeEmpty();
})->group('requests');
