<?php

namespace Payeer\Responses\Mappers;

use Payeer\Enums\Action;
use Payeer\Enums\Status;
use Payeer\Responses\Models\MyTrade;
use Spatie\DataTransferObject\Caster;

/**
 * Mapper of MyTrades API method response to the domain model
 */
class MyTradesPairsMapper implements Caster
{
    /**
     * Maps TradesResponse pairs property
     * @param array|mixed $value
     * @return mixed
     */
    public function cast(mixed $value): array
    {
        $result = [];

        foreach ($value as $id => $pair) {
            $model = new MyTrade();
            $model->id = $pair['id'];
            $model->date = $pair['date'];

            $parts = explode('_', $pair['pair']);
            $model->currencyPair = [$parts[0], $parts[1]];

            $model->action = Action::from($pair['action']);
            $model->status = Status::from($pair['status']);
            $model->amount = $pair['amount'];
            $model->price = $pair['price'];
            $model->value = $pair['value'];
            $model->isMaker = $pair['is_maker'];
            $model->isTaker = $pair['is_taker'];

            if (array_key_exists('m_transaction_id', $pair)) {
                $model->makerTransactionId = $pair['m_transaction_id'];
            }

            if (array_key_exists('t_transaction_id', $pair)) {
                $model->takerTransactionId = $pair['t_transaction_id'];
            }

            $result[] = $model;
        }

        return $result;
    }
}
