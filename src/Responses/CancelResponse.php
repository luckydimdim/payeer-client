<?php

namespace Payeer\Responses;

use Spatie\DataTransferObject\Attributes\MapFrom;

/**
 * Cancel response model
 */
class CancelResponse extends ResponseBase
{
    /**
     * @var array<int>
     */
    #[MapFrom('items')]
    public array $data = [];
}
