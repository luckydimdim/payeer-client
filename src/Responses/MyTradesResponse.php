<?php

namespace Payeer\Responses;

use Payeer\Responses\Mappers\MyTradesPairsMapper;
use Payeer\Responses\Mappers\TradesPairsMapper;
use Payeer\Responses\Models\MyTrade;
use Payeer\Responses\Models\Trades;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Attributes\MapFrom;

/**
 *  My trades response model
 */
class MyTradesResponse extends ResponseBase
{
    /**
     * @var array<MyTrade>
     */
    #[MapFrom('items')]
    #[CastWith(MyTradesPairsMapper::class)]
    public array $data = [];
}
