# payeer-client
Payeer Trade API Client

$api = new PayeerClient(
    // TODO: handle trailing slash
    url: 'https://payeer.com/api/trade',
    id: 'bd443f00-092c-4436-92a4-a704ef679e24',
    sign: 'sign');
$result = $api->isOk();

$params = [
    [Currency::BTC, Currency::USD],
    [Currency::BTC, Currency::RUB]
];

$result = $api->getRates($params);
$result = $api->getStats($params);
$result = $api->getOrders($params);

$result = $api->getTrades($params);
$result = $api->getBalance();
$result = $api->getHistory(
    currencyPairs: $params,
    action: 'buy',
    dateFrom: 1630443600, // TODO: make normal dateTime
    dateTo: 1633035599,
    lastOrderId: 36989301,
    pageSize: 3
);

$result = $api->order->create(
    currencyPair: [Currency::BTC, Currency::USD],
    type: 'limit', // TODO: can be enum? limit | market | stopLimit
    action: 'buy', // TODO: enum?
    quantity: 10,
    price: 0.08,
    stopPrice: 0.078);

$result = $api->order->getStatus(37054293);
$result = $api->order->cancel(37054293);
$result = $api->order->cancel(currencyPairs: $params, action: 'buy');
$result = $api->order->cancel();
$result = $api->order->list(
    currencyPairs: $params,
    action: 'buy',
    status: 'opened', // TODO: merge history and list methods, make enum
    dateFrom: 1630443600, // TODO: make normal dateTime
    dateTo: 1633035599,
    lastOrderId: 36989301,
    pageSize: 3
);