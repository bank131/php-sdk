<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\Collection;

use Bank131\SDK\DTO\AcquiringPaymentRefund;

class AcquiringPaymentRefundCollection extends AbstractCollection
{
    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return AcquiringPaymentRefund::class;
    }
}