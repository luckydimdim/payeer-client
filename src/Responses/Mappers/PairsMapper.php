<?php

namespace Payeer\Responses\Mappers;

use Payeer\Enums\Currency;
use Payeer\Responses\Models\Pair;
use Spatie\DataTransferObject\Caster;

class PairsMapper implements Caster
{
    /**
     * Maps RatesResponse Pairs property
     * @param array|mixed $value
     * @return mixed
     */
    public function cast(mixed $value): array
    {
        $result = [];

        foreach ($value as $currencies => $pair) {
            $model = new Pair();

            $parts = explode('_', $currencies);

            $model->currencyPair = [Currency::from($parts[0]), Currency::from($parts[1])];
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
{

}
