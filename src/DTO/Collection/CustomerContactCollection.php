<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\Collection;

use Bank131\SDK\DTO\CustomerContact;

class CustomerContactCollection extends AbstractCollection
{
    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return CustomerContact::class;
    }
}