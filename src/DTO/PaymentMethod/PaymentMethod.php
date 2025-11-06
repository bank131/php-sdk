<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\PaymentMethod;

abstract class PaymentMethod
{
    public abstract function getPaymentMethodType(): string;
}
