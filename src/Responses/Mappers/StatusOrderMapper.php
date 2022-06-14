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
 * User order mapper
 */
class StatusOrderMapper implements Caster
{
    /**
     * Maps Responses related to user's orders
     * @param array|mixed $value
     * @return PayeerOrder
     */
    public function cast(mixed $value): PayeerOrder
    {
        $model = new PayeerOrder();

        $model->id = intval($value['id']);
        $model->date = $value['date'];

        $parts = explode('_', $value['pair']);
        $model->currencyPair = [Currency::from($parts[0]), Currency::from($parts[1])];

        $model->action = Action::from($value['action']);
        $model->type = Type::from($value['type']);

        $model->status = Status::from($value['status']);
        $model->amount = $value['amount'];
        $model->price = $value['price'];
        $model->value = $value['value'];
        $model->amountProcessed = $value['amount_processed'];
        $model->amountRemaining = $value['amount_remaining'];
        $model->valueProcessed = $value['value_processed'];
        $model->valueRemaining = $value['value_remaining'];
        $model->averagePrice = $value['avg_price'];
        $model->trades = $this->mapTrades($value['trades']);

        return $model;
    }

    /**
     * Maps trades parameter
     * @param array $trades
     * @return array<PayeerTrade>
     */
    protected function mapTrades(array $trades): array
    {
        $result = [];

        foreach ($trades as $trade) {
            $model = new PayeerTrade();
            $model->id = $trade['id'];
            $model->date = $trade['date'];
            $model->status = Status::from($trade['status']);
            $model->price = $trade['price'];
            $model->amount = $trade['amount'];
            $model->value = $trade['value'];
            $model->isMaker = $trade['is_maker'];
            $model->isTaker = $trade['is_taker'];
            $model->transactionId = $trade['t_transaction_id'];

            $result[] = $model;
        }

        return $result;
    }
}
