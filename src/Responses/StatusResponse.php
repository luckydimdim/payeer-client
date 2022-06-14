<?php

namespace Payeer\Responses;

use Payeer\Responses\Mappers\StatusOrderMapper;
use Payeer\Responses\Models\PayeerOrder;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Attributes\MapFrom;

/**
 * Order status response model
 */
class StatusResponse extends ResponseBase
{
    /**
     * @var PayeerOrder|null
     */
    #[MapFrom('order')]
    #[CastWith(StatusOrderMapper::class)]
    public ?PayeerOrder $data = null;
}
