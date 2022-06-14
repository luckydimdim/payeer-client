<?php

namespace Payeer;

/**
 * Order operations facade
 */
class PayeerOrderClient
{
    public function __construct(
        string $uri,
        string $id,
        private readonly IService $service
    ) { }

    /**
     * Fetches order data by ID
     * @param int $id
     * @return StatusResponse
     */
    public function status(int $id): StatusResponse
    {
        return $this->service->getStatus($id);
    }
}
