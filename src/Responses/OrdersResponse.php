<?php

namespace Payeer\Responses;

use Payeer\Responses\Mappers\OrderPairsMapper;
use Payeer\Responses\Models\Order;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Attributes\MapFrom;

/**
 *  Orders response model
 */
class OrdersResponse extends ResponseBase
{
    /**
     * @var array<Order>
     */
    #[MapFrom('pairs')]
    #[CastWith(OrderPairsMapper::class)]
    public array $data = [];
}
