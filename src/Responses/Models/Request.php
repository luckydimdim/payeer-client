<?php

namespace Payeer\Responses\Models;

use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\DataTransferObject;

class Request extends DataTransferObject
{
    public string $interval = '';

    #[MapFrom('interval_num')]
    public int $intervalNumber;

    public int $limit;
}
