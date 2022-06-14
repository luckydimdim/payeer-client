<?php

namespace Payeer\Responses\Mappers;

use Payeer\Enums\Action;
use Payeer\Enums\Currency;
use Payeer\Enums\Status;
use Payeer\Enums\Type;
use Payeer\Responses\Models\PayeerOrder;
use Payeer\Responses\Models\PayeerTrade;
use Spatie\DataTransferObject\Caster;

/**
 * User orders mapper
 */
class PayeerOrderMapper implements Caster
{
    /**
     * Maps Responses related to user's orders
     * @param array|mixed $value
     * @return mixed
     */
    public function cast(mixed $value): array
    {
        $result = [];

        foreach ($value as $id => $pair) {
            $model = new PayeerOrder();

            $model->id = $id;
            $model->date = $pair['date'];

            $parts = explode('_', $pair['pair']);
            $model->currencyPair = [Currency::from($parts[0]), Currency::from($parts[1])];

            $model->action = Action::from($pair['action']);
            $model->type = Type::from($pair['type']);

            // Handle response differences of my_history and my_orders
            if (array_key_exists('status', $pair)) {
                $model->status = Status::from($pair['status']);
            } else {
                $model->status = Status::Opened;
            }

            $model->amount = $pair['amount'];
            $model->price = $pair['price'];

            if (array_key_exists('stop_price', $pair)) {
                $model->stopPrice = $pair['stop_price'];
            }

            $model->value = $pair['value'];
            $model->amountProcessed = $pair['amount_processed'];
            $model->amountRemaining = $pair['amount_remaining'];
            $model->valueProcessed = $pair['value_processed'];
            $model->valueRemaining = $pair['value_remaining'];

            if (array_key_exists('api', $pair)) {
                $model->api = $pair['api'];
            }

            $result[] = $model;
        }

        return $result;
    }
}
