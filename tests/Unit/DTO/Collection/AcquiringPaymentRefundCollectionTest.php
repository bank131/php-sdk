<?php

declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit\DTO\Collection;

use Bank131\SDK\DTO\Collection\AbstractCollection;
use Bank131\SDK\DTO\Collection\AcquiringPaymentRefundCollection;

class AcquiringPaymentRefundCollectionTest extends AbstractCollectionTest
{
    protected function createCollection(array $elements = []): AbstractCollection
    {
        return new AcquiringPaymentRefundCollection($elements);
    }
}