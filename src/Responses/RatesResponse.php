<?php

namespace Payeer\Responses;

use Payeer\Responses\Mappers\PairsMapper;
use Payeer\Responses\Models\Pair;
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
     * @var array<Pair>
     */
    #[CastWith(PairsMapper::class)]
    public array $pairs = [];
}
