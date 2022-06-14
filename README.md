# payeer-client
Payeer Trade API Client

$api = new PayeerClient(
    url: 'https://payeer.com/api/trade',
    id: 'bd443f00-092c-4436-92a4-a704ef679e24');
$result = $api->isOk();

$params = [
    [Currency::Btc, Currency::Usd],
    [Currency::Btc, Currency::Rub]
];

$result = $api->rates($params);
$result = $api->stats($params);
$result = $api->orders($params);

$result = $api->trades($params);
$result = $api->balance();

$result = $api->order->list(
    currencyPairs: $params,
    action: Action::Buy,
    status: Status::Opened,
    dateFrom: 1630443600, // TODO: make normal dateTime
    dateTo: 1633035599,
    lastOrderId: 36989301,
    pageSize: 3
);

$result = $api->order->cancel();
$result = $api->order->cancel(37054293);
$result = $api->order->cancel(
    currencyPairs: $params, 
    action: Action::Buy
);

$result = $api->order->status(37054293);

$result = $api->order->create(
    currencyPair: [Currency::Btc, Currency::Usd],
    type: Type::Limit,
    action: Action::Buy,
    quantity: 10,
    price: 0.08,
    stopPrice: 0.078);

