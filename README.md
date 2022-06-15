# Payeer Trade API Client

###### Installation
```
composer require bobel\payeer-client
```

###### Testing
```
composer init-pest
composer test
```

###### Init the client
```
$api = new PayeerClient(
    id: 'bd443f00-092c-4436-92a4-a704ef679e24',
    key: 'your_key');
```

###### Check connection
```
$result = $api->isOk();
```
Returns `IsOkResponse` object.<br />
*Throws IsOkException.*

###### Get all rates
```
$result = $api->rates();
```
Returns `RatesResponse`.<br />
*Throws ClientException.*

###### Get rates by criteria
```
$result = $api->rates([
    [Currency::Btc, Currency::Usd],
    [Currency::Btc, Currency::Rub]
]);
```
Returns `RatesResponse`.<br />
*Throws ClientException.*

###### Get stats
```
$result = $api->stats([
    [Currency::Btc, Currency::Usd]
]);
```
Returns `StatsResponse`.

###### Get orders
```
$result = $api->orders([
    [Currency::Btc, Currency::Usd],
    [Currency::Btc, Currency::Rub]
]);
```
Returns `OrdersResponse`.

###### Get trades
```
$result = $api->trades([
    [Currency::Btc, Currency::Usd],
    [Currency::Btc, Currency::Rub]
]);
```
Returns `TradesResponse`.

###### Get my trades
```
// Get all trades
$result = $api->myTrades();

// Get specific trades by criteria
$result = $api->myTrades(
        currencyPairs: [
            [Currency::Btc, Currency::Usd],
            [Currency::Btc, Currency::Rub]
        ],
        action: Action::Buy,
        dateFrom: 1630443600,
        dateTo: 1633035599,
        pageSize: 3);
```
Returns `MyTradesResponse`.<br />

###### Get balance
```
$result = $api->balance();
```
Returns `BalanceResponse`.

## Order related operations
###### List orders
```
    // Get all my orders
    $result = $api->order->list(status: Status::Opened);
        
    // Get my orders by criteria
    $result = $api->order->list(
        status: Status::Opened,
        currencyPairs: [
            [Currency::Btc, Currency::Usd],
            [Currency::Trx, Currency::Usd]
        ],
        action: Action::Buy);
        
    // Get all orders
    $result = $api->order->list(pageSize: 3);
    
    // Get all orders by criteria
    $result = $api->order->list(
        status: Status::Canceled,
        currencyPairs: [
            [Currency::Btc, Currency::Usd],
            [Currency::Btc, Currency::Rub]
        ],
        action: Action::Buy,
        dateFrom: 1630443600,
        dateTo: 1633035599,
        pageSize: 3);    
```
Returns `ListResponse`.

###### Cancel orders
```
    // Cancel all orders
    $result = $api->order->cancel();
    
    // Cancel orders by criteria
    $result = $api->order->cancel(
        currencyPairs: [
            [Currency::Trx, Currency::Rub],
            [Currency::Doge, Currency::Rub]
        ],
        action: Action::Buy);
        
    // Cancel exact order by ID
    $result = $api->order->cancel(37054293);
```
Returns `CancelResponse`.

###### Get order status
```
$result = $api->order->status(37054293);
```
Returns `StatusResponse`.

###### Create an order
```
$result = $api->order->create(
    currencyPairs: [
        [Currency::Trx, Currency::Usd]
    ],
    type: Type::Limit,
    action: Action::Buy,
    amount: 10,
    price: 0.08);
```
Returns `CreateResponseResponse`.
