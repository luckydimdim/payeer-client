<?php

namespace Payeer\Responses;

use Payeer\Responses\Mappers\BalancePairsMapper;
use Payeer\Responses\Models\Balance;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Attributes\MapFrom;

/**
 * Balance response model
 */
class BalanceResponse extends ResponseBase
{
    /**
     * @var array<Balance>
     */
    #[MapFrom('balances')]
    #[CastWith(BalancePairsMapper::class)]
    public array $data = [];
}
