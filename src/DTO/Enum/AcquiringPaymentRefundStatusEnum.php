<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\Enum;

use Bank131\SDK\Helper\BaseEnum;

class AcquiringPaymentRefundStatusEnum extends BaseEnum
{
    /**
     * This status means that refund is finished successfully.
     */
    public const ACCEPTED = 'accepted';

    /**
     * This status means that refund is being processed.
     */
    public const IN_PROGRESS = 'in_progress';

    /**
     * This status means that refund is declined.
     */
    public const DECLINED = 'declined';

    /**
     * This status means that refund is finished unsuccessfully. An error happened during refund processing.
     */
    public const ERROR = 'error';
}