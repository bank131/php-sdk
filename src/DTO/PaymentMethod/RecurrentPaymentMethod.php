<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\PaymentMethod;

use Bank131\SDK\DTO\PaymentMethod\Enum\PaymentMethodEnum;

class RecurrentPaymentMethod extends PaymentMethod
{
    /**
     * @var string
     */
    private $token;

    /**
     * RecurrentPaymentMethod constructor.
     *
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return PaymentMethodEnum::RECURRENT;
    }
}