<?php

namespace Payeer\Responses\Mappers;

use Payeer\Enums\Currency;
use Payeer\Responses\Models\Balance;
use Spatie\DataTransferObject\Caster;

/**
 * Mapper of Balance API method response to the domain model
 */
class BalancePairsMapper implements Caster
{
    /**
     * Maps BalanceResponse pairs property
     * @param array|mixed $value
     * @return mixed
     */
    public function cast(mixed $value): array
    {
        $result = [];

        foreach ($value as $currency => $pair) {
            $model = new Balance();

            $model->currency = Currency::from($currency);
            $model->total = $pair['total'];
            $model->available = $pair['available'];
            $model->hold = $pair['hold'];

            $result[] = $model;
        }

        return $result;
    }
}
