<?php

namespace Payeer\Responses;

use Payeer\Responses\Mappers\OrderCreateMapper;
use Payeer\Responses\Models\CreatedOrder;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Attributes\MapFrom;

/**
 * Order Create response model
 */
class CreateResponse extends ResponseBase
{
    #[MapFrom('order_id')]
    public ?int $id = null;

    /**
     * @var CreatedOrder|null
     */
    #[MapFrom('params')]
    #[CastWith(OrderCreateMapper::class)]
    public ?CreatedOrder $data = null;
}
