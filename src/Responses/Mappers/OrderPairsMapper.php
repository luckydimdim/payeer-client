<?php

namespace Payeer\Responses\Mappers;

use Payeer\Enums\Currency;
use Payeer\Responses\Models\Ask;
use Payeer\Responses\Models\Order;
use Spatie\DataTransferObject\Caster;

/**
 * Mapper of Order API method response to the domain model
 */
class OrderPairsMapper implements Caster
{
    /**
     * Maps OrdersResponse properties
     * @param array|mixed $value
     * @return mixed
     */
    public function cast(mixed $value): array
    {
        $result = [];

        foreach ($value as $currencies => $pair) {
            $model = new Order();

            $parts = explode('_', $currencies);

            $model->currencyPair = [Currency::from($parts[0]), Currency::from($parts[1])];
            $model->ask = $pair['ask'];
            $model->bid = $pair['bid'];

            if (array_key_exists('asks', $pair) && $pair['asks']) {
                $model->asks = $this->mapAsks($pair['asks']);
            }

            if (array_key_exists('bids', $pair) && $pair['bids']) {
                $model->bids = $this->mapBids($pair['bids']);
            }

            $result[] = $model;
        }

        return $result;
    }

    /**
     * Maps asks property to the order model
     * @param array $asks
     * @return array<Ask>
     */
    protected function mapAsks(array $asks): array
    {
        $result = [];

        foreach ($asks as $ask) {
            $model = new Ask();
            $model->price = $ask['price'];
            $model->amount = $ask['amount'];
            $model->value = $ask['value'];

            $result[] = $model;
        }

        return $result;
    }

    /**
     * Maps bids property to the order model
     * @param array $bids
     * @return array<Ask>
     */
    protected function mapBids(array $bids): array
    {
        $result = [];

        foreach ($bids as $bid) {
            $model = new Ask();
            $model->price = $bid['price'];
            $model->amount = $bid['amount'];
            $model->value = $bid['value'];

            $result[] = $model;
        }

        return $result;
    }
}
