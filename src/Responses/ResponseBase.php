<?php

namespace Payeer\Responses;

use Payeer\Exceptions\Api\AccessDeniedException;
use Payeer\Exceptions\Api\ApiException;
use Payeer\Exceptions\Api\IncorrectPriceException;
use Payeer\Exceptions\Api\InsufficientFundsException;
use Payeer\Exceptions\Api\InsufficientVolumeException;
use Payeer\Exceptions\Api\InvalidDateRangeException;
use Payeer\Exceptions\Api\InvalidIpAddressException;
use Payeer\Exceptions\Api\InvalidParameterException;
use Payeer\Exceptions\Api\InvalidSignatureException;
use Payeer\Exceptions\Api\InvalidStatusForRefundException;
use Payeer\Exceptions\Api\InvalidTimestampException;
use Payeer\Exceptions\Api\LimitExceededException;
use Payeer\Exceptions\Api\MinAmountException;
use Payeer\Exceptions\Api\MinValueException;
use Payeer\Exceptions\Api\ParameterEmptyException;
use Payeer\Exceptions\Api\RefundLimitException;
use Payeer\Exceptions\Api\UnknownErrorException;
use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\DataTransferObject;

/**
 * Base response model
 */
abstract class ResponseBase extends DataTransferObject
{
    /**
     * @var bool a general result of the operation
     */
    public bool $success = false;

    #[MapFrom('error.code')]
    public string $errorCode = '';

    /**
     * Checks if there is any API level errors and triggers Exceptions
     * @return void
     * @throws \Exception
     * TODO: test this method
     */
    public function handleApiErrors(): void
    {
        if (!$this->errorCode) {
            return;
        }

        throw match ($this->errorCode) {
            'INVALID_SIGNATURE' => new InvalidSignatureException(),
            'INVALID_IP_ADDRESS' => new InvalidIpAddressException(),
            'LIMIT_EXCEEDED' => new LimitExceededException(),
            'INVALID_TIMESTAMP' => new InvalidTimestampException(),
            'ACCESS_DENIED' => new AccessDeniedException(),
            'INVALID_PARAMETER' => new InvalidParameterException(),
            'PARAMETER_EMPTY' => new ParameterEmptyException(),
            'INVALID_STATUS_FOR_REFUND' => new InvalidStatusForRefundException(),
            'REFUND_LIMIT' => new RefundLimitException(),
            'UNKNOWN_ERROR' => new UnknownErrorException(),
            'INVALID_DATE_RANGE' => new InvalidDateRangeException(),
            'INSUFFICIENT_FUNDS' => new InsufficientFundsException(),
            'INSUFFICIENT_VOLUME' => new InsufficientVolumeException(),
            'INCORRECT_PRICE' => new IncorrectPriceException(),
            'MIN_AMOUNT' => new MinAmountException(),
            'MIN_VALUE' => new MinValueException(),
            default => new ApiException(),
        };
    }

    /**
     * Serializes an object to JSON format
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->toArray(), JSON_PRETTY_PRINT);
    }
}
