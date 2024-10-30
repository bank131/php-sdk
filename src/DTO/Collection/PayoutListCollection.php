<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\Collection;

use Bank131\SDK\DTO\Payout;

class PayoutListCollection extends AbstractCollection
{
    /**
     * @return class-string
     */
    public function getType(): string
    {
        return Payout::class;
    }
}