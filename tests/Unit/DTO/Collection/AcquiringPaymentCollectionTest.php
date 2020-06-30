<?php

declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit\DTO\Collection;

use Bank131\SDK\DTO\Collection\AbstractCollection;
use Bank131\SDK\DTO\Collection\AcquiringPaymentCollection;

class AcquiringPaymentCollectionTest extends AbstractCollectionTest
{
    protected function createCollection(array $elements = []): AbstractCollection
    {
        return new AcquiringPaymentCollection($elements);
    }
}