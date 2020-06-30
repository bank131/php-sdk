<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\Collection;

use Bank131\SDK\DTO\AcquiringPayment;

class AcquiringPaymentCollection extends AbstractCollection
{
    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return AcquiringPayment::class;
    }
}