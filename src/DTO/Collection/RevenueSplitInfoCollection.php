<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\Collection;

use Bank131\SDK\DTO\RevenueSplitInfo\RevenueSplitInfoItem;

class RevenueSplitInfoCollection extends AbstractCollection
{
    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return RevenueSplitInfoItem::class;
    }
}