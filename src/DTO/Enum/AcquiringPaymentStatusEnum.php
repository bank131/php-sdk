<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\Enum;

use Bank131\SDK\Helper\BaseEnum;

class AcquiringPaymentStatusEnum extends BaseEnum
{
    /**
     * This status means that payment is finished successfully.
     */
    public const SUCCEEDED = 'succeeded';

    /**
     * This status means that payment is being processed.
     */
    public const IN_PROGRESS = 'in_progress';

    /**
     * This status means that payment is waiting for confirmation.
     */
    public const PENDING = 'pending';

    /**
     * This status means that payment is finished unsuccessfully. An error happened during payment processing.
     */
    public const FAILED = 'failed';
}