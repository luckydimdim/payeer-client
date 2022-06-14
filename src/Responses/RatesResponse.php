<?php

namespace Payeer\Responses;

use Payeer\Responses\Mappers\RatesPairsMapper;
use Payeer\Responses\Models\Rate;
use Payeer\Responses\Models\Request;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\Casters\ArrayCaster;

/**
 * Rates response model
 */
class RatesResponse extends ResponseBase
{
    /**
     * @var array<Request>
     */
    #[MapFrom('limits.requests')]
    #[CastWith(ArrayCaster::class, itemType: Request::class)]
    public array $limits = [];

    /**
     * @var array<Rate>
     */
    #[MapFrom('pairs')]
    #[CastWith(RatesPairsMapper::class)]
    public array $data = [];
}
