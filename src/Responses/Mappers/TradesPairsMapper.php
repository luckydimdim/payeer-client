<?php

namespace Payeer\Responses\Mappers;

use Payeer\Enums\Action;
use Payeer\Responses\Models\Trade;
use Payeer\Responses\Models\Trades;
use Spatie\DataTransferObject\Caster;

/**
 * Mapper of Trades API method response to the domain model
 */
class TradesPairsMapper implements Caster
{
    /**
     * Maps TradesResponse pairs property
     * @param array|mixed $value
     * @return mixed
     */
    public function cast(mixed $value): array
    {
        $result = [];

        foreach ($value as $currencies => $pair) {
            $model = new Trades();

            $parts = explode('_', $currencies);
            $model->currencyPair = [$parts[0], $parts[1]];

            $model->trades = $this->mapTrades($pair);

            $result[] = $model;
        }

        return $result;
    }

    /**
     * Maps trades property
     * @param array $trades
     * @return array<Trade>
     */
    protected function mapTrades(array $trades): array
    {
        $result = [];

        foreach ($trades as $trade) {
            $model = new Trade();

            $model->id = $trade['id'];
            $model->date = $trade['date'];
            $model->type = Action::from($trade['type']);
            $model->amount = $trade['amount'];
            $model->price = $trade['price'];
            $model->value = $trade['value'];

            $result[] = $model;
        }

        return $result;
    }
}
