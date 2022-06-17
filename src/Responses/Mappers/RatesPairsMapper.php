<?php

namespace Payeer\Responses\Mappers;

use Payeer\Responses\Models\Rate;
use Spatie\DataTransferObject\Caster;

/**
 * Mapper of Rates API method response to the domain model
 */
class RatesPairsMapper implements Caster
{
    /**
     * Maps RatesResponse pairs property
     * @param array|mixed $value
     * @return mixed
     */
    public function cast(mixed $value): array
    {
        $result = [];

        foreach ($value as $currencies => $pair) {
            $model = new Rate();

            $parts = explode('_', $currencies);

            $model->currencyPair = [$parts[0], $parts[1]];
            $model->pricePrecision = $pair['price_prec'];
            $model->minPrice = $pair['min_price'];
            $model->maxPrice = $pair['max_price'];
            $model->minAmount = $pair['min_amount'];
            $model->minValue = $pair['min_value'];
            $model->feeMakerPercent = $pair['fee_maker_percent'];
            $model->feeTakerPercent = $pair['fee_taker_percent'];

            $result[] = $model;
        }

        return $result;
    }
}
