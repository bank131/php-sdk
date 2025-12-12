<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\PaymentMethod;

use Bank131\SDK\DTO\PaymentMethod\Enum\PaymentMethodEnum;

class FasterPaymentSystemBindingPaymentMethod extends PaymentMethod
{
    public function getType(): string
    {
        return PaymentMethodEnum::FASTER_PAYMENT_SYSTEM_BINDING;
    }
}
