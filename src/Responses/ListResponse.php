<?php

namespace Payeer\Responses;

use Payeer\Responses\Mappers\PayeerOrderMapper;
use Payeer\Responses\Models\PayeerOrder;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Attributes\MapFrom;

/**
 *  List response model
 */
class ListResponse extends ResponseBase
{
    /**
     * @var array<PayeerOrder>
     */
    #[MapFrom('items')]
    #[CastWith(PayeerOrderMapper::class)]
    public array $data = [];
}
