<?php

namespace Payeer\Requests;

/**
 * Order status request model
 */
class StatusRequest extends RequestBase
{
    public int $order_id = 0;

    /**
     * @param int $id
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function __construct(int $id)
    {
        parent::__construct();

        $this->setUri('/trade/order_status');

        $this->order_id = $id;
    }
}
