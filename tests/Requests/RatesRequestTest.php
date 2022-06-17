<?php

use Payeer\Enums\HttpMethod;
use Payeer\Requests\RatesRequest;
use Payeer\Tests\Mocks\ServiceMock;
use Payeer\Tests\Mocks\TransportMock;

beforeEach(function () {
    $this->service = new ServiceMock('dummy_id', 'dummy_key', 'dummy_uri');
    $this->transport = new TransportMock('dummy_id', 'dummy_key', 'dummy_uri');
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
        ["BTC", "USD"]
    ]))->toEqual('BTC_USD');
})->group('requests');

test('getPairs parses multiple pairs correctly', function () {
    expect($this->request->getPairs([
        ["BTC", "USD"],
        ["BTC", "RUB"]
    ]))->toEqual('BTC_USD,BTC_RUB');
})->group('requests');

test('validateParams handles incorrect number of elements in a pair', function () {
    $this->request->validateParams(["BTC"]);
})->throws('Incorrect parameters format.')->group('requests');

test('validateParams handles incorrect type of pair elements', function () {
    $this->request->validateParams([2, 'USD']);
})->throws('Incorrect parameters type.')->group('requests');

test('validateParams handles incorrect pair elements combinations', function () {
    $this->request->validateParams(["BTC", "BTC"]);
})->throws('Incorrect parameters combination.')->group('requests');

it('RatesRequest accepts proper POST params from service layer', function () {
    $request = $this->service->getRequestModel('rates', [
        [["BTC", "USD"]]
    ]);

    $this->transport->send($request);

    expect($this->transport->getClient()->method)->toEqual(HttpMethod::Post->value);
    expect($this->transport->getClient()->uri)->toEqual('/trade/info');
    expect($this->transport->getClient()->options['json']['pair'])->toEqual('BTC_USD');
})->group('requests');

it('RatesRequest accepts proper GET params from service layer', function () {
    $request = $this->service->getRequestModel('rates', []);

    $this->transport->send($request);

    expect($this->transport->getClient()->method)->toEqual(HttpMethod::Get->value);
    expect($this->transport->getClient()->uri)->toEqual('/trade/info');
    expect($this->transport->getClient()->options['json']['pair'])->toBeEmpty();
})->group('requests');
