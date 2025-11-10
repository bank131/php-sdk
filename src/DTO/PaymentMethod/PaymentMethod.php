<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\PaymentMethod;

abstract class PaymentMethod
{
    /**
     * @return string
     */
    abstract public function getType(): string;
}