<?php

namespace Payeer\Responses;

use Payeer\Responses\Mappers\StatsPairsMapper;
use Payeer\Responses\Models\Rate;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Attributes\MapFrom;

/**
 * Stats response model
 */
class StatsResponse extends ResponseBase
{
    /**
     * @var array<Rate>
     */
    #[MapFrom('pairs')]
    #[CastWith(StatsPairsMapper::class)]
    public array $data = [];
}
