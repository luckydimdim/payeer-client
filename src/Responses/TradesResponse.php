<?php

namespace Payeer\Responses;

use Payeer\Responses\Mappers\TradesPairsMapper;
use Payeer\Responses\Models\Trades;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Attributes\MapFrom;

/**
 *  Trades response model
 */
class TradesResponse extends ResponseBase
{
    /**
     * @var array<Trades>
     */
    #[MapFrom('pairs')]
    #[CastWith(TradesPairsMapper::class)]
    public array $data = [];
}
