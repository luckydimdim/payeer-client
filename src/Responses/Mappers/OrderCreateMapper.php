<?php

namespace Payeer\Responses\Mappers;

use Payeer\Enums\Action;
use Payeer\Enums\Type;
use Payeer\Responses\Models\CreatedOrder;
use Spatie\DataTransferObject\Caster;

/**
 * Mapper of Order Crate API method response to the domain model
 */
class OrderCreateMapper implements Caster
{
    /**
     * Maps CreateResponse properties
     * @param array|mixed $value
     * @return CreatedOrder
     */
    public function cast(mixed $value): CreatedOrder
    {
        $model = new CreatedOrder();

        $parts = explode('_', $value['pair']);
        $model->currencyPair = [$parts[0], $parts[1]];
        $model->type = Type::from($value['type']);
        $model->action = Action::from($value['action']);
        $model->amount = $value['amount'];
        $model->price = $value['price'];
        $model->value = $value['value'];

        return $model;
    }
}
