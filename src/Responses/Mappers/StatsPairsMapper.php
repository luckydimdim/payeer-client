<?php

namespace Payeer\Responses\Mappers;

use Payeer\Responses\Models\Stats;
use Spatie\DataTransferObject\Caster;

/**
 * Mapper of Stats API method response to the domain model
 */
class StatsPairsMapper implements Caster
{
    /**
     * Maps StatsResponse pairs property
     * @param array|mixed $value
     * @return mixed
     */
    public function cast(mixed $value): array
    {
        $result = [];

        foreach ($value as $currencies => $pair) {
            $model = new Stats();

            $parts = explode('_', $currencies);

            $model->currencyPair = [$parts[0], $parts[1]];
            $model->ask = $pair['ask'];
            $model->bid = $pair['bid'];
            $model->last = $pair['last'];
            $model->min24 = $pair['min24'];
            $model->max24 = $pair['max24'];
            $model->delta = $pair['delta'];
            $model->deltaPrice = $pair['delta_price'];

            $result[] = $model;
        }

        return $result;
    }
}
