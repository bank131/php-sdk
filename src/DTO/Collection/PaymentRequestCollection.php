<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\Collection;

use Bank131\SDK\API\Request\Session\InitPaymentSessionRequest;

class PaymentRequestCollection extends AbstractCollection
{
    public function getType(): string
    {
        return InitPaymentSessionRequest::class;
    }
}
