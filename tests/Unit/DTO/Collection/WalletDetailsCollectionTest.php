<?php

declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit\DTO\Collection;

use Bank131\SDK\DTO\Collection\WalletDetailsCollection;
use Bank131\SDK\DTO\Collection\AbstractCollection;

class WalletDetailsCollectionTest extends AbstractCollectionTest
{
    protected function createCollection(array $elements = []): AbstractCollection
    {
        return new WalletDetailsCollection($elements);
    }
}