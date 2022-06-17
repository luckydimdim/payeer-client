# Payeer Trade API Client

###### Installation
```bash
composer require bobel\payeer-client
```

###### Testing
```bash
composer init-pest
composer test
```

###### Init the client
```php
$api = new PayeerClient(
    id: 'bd443f00-092c-4436-92a4-a704ef679e24',
    key: 'your_key');
```

###### Check connection
```php
$result = $api->isOk();
```
Returns `IsOkResponse` object.<br />
*Throws IsOkException.*

###### Run WebSocket Server
```php
$webSocket = new WebSocketServer(
    id: 'bd443f00-092c-4436-92a4-a704ef679e24',
    key: 'your_key');

$webSocket->run();
```

###### WebSocket request/response format
**Request**
```json
{
  "method": "rates",
  "params": {
    "currencyPairs": [
      ["BTC", "USD"],
      ["BTC", "RUB"]
    ],    
    "action": "Action::Buy",
    "dateFrom": 1630443600,
    "dateTo": 1633035599,
    "pageSize": 3
  }
}
```

**Response**
```json
{
  "success": true,
  "limits": {
    "interval": "min",
    "intervalNumber": 1,
    "limit": 600
  },
  "data": [
    {
      "currencyPair": ["BTC", "USD"],
      "pricePrecision": 2,
      "minPrice": "4375.74",
      "maxPrice": "83139.00",
      "minAmount": 0.0001,
      "minValue": 0.5,
      "feeMakerPercent": 0.01,
      "feeTakerPercent": 0.095      
    },
    {
      "currencyPair": ["BTC", "RUB"],
      "pricePrecision": 2,
      "minPrice": "326269.32",
      "maxPrice": "6199117.08",
      "minAmount": 0.0001,
      "minValue": 20,
      "feeMakerPercent": 0.01,
      "feeTakerPercent": 0.095      
    }
  ]
}

```

###### Get rates


###### Get rates by criteria
```php
// Get all rates
$result = $api->rates();

// Get rates by criteria
$result = $api->rates([
    ["BTC", "USD"],
    ["BTC", "RUB"]
]);
```

Returns `RatesResponse`.<br />
*Throws ClientException.*

###### Get stats
```php
$result = $api->stats([
    ["BTC", "USD"]
]);
```
Returns `StatsResponse`.

###### Get orders
```php
$result = $api->orders([
    ["BTC", "USD"],
    ["BTC", "RUB"]
]);
```
Returns `OrdersResponse`.

###### Get trades
```php
$result = $api->trades([
    ["BTC", "USD"],
    ["BTC", "RUB"]
]);
```
Returns `TradesResponse`.

###### Get my trades
```php
// Get all trades
$result = $api->myTrades();

// Get specific trades by criteria
$result = $api->myTrades(
        currencyPairs: [
            ["BTC", "USD"],
            ["BTC", "RUB"]
        ],
        action: Action::Buy,
        dateFrom: 1630443600,
        dateTo: 1633035599,
        pageSize: 3);
```
Returns `MyTradesResponse`.<br />

###### Get balance
```php
$result = $api->balance();
```
Returns `BalanceResponse`.

## Order related operations
###### List orders
```php
    // Get all my orders
    $result = $api->order->list(status: Status::Opened);
        
    // Get my orders by criteria
    $result = $api->order->list(
        status: Status::Opened,
        currencyPairs: [
            ["BTC", "USD"],
            ["BTC", "RUB"]
        ],
        action: Action::Buy);
        
    // Get all orders
    $result = $api->order->list(pageSize: 3);
    
    // Get all orders by criteria
    $result = $api->order->list(
        status: Status::Canceled,
        currencyPairs: [
            ["BTC", "USD"],
            ["BTC", "RUB"]
        ],
        action: Action::Buy,
        dateFrom: 1630443600,
        dateTo: 1633035599,
        pageSize: 3);    
```
Returns `ListResponse`.

###### Cancel orders
```php
    // Cancel all orders
    $result = $api->order->cancel();
    
    // Cancel orders by criteria
    $result = $api->order->cancel(
        currencyPairs: [
            ["TRX", "RUB"],
            ["DOGE", "RUB"]
        ],
        action: Action::Buy);
        
    // Cancel exact order by ID
    $result = $api->order->cancel(37054293);
```
Returns `CancelResponse`.

###### Get order status
```php
$result = $api->order->status(37054293);
```
Returns `StatusResponse`.

###### Create an order
```php
$result = $api->order->create(
    currencyPairs: [
        ["TRX", "USD"]
    ],
    type: Type::Limit,
    action: Action::Buy,
    amount: 10,
    price: 0.08);
```
Returns `CreateResponseResponse`.
