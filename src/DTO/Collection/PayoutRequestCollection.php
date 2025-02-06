<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\Collection;

use Bank131\SDK\API\Request\Session\InitPayoutSessionRequest;

class PayoutRequestCollection extends AbstractCollection
{
    public function getType(): string
    {
        return InitPayoutSessionRequest::class;
    }
}
