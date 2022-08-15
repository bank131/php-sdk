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
     * @var string|null
     */
    private $initiator;

    /**
     * RecurrentPaymentMethod constructor.
     *
     * @param string      $token
     * @param string|null $initiator
     */
    public function __construct(string $token, ?string $initiator = null)
    {
        $this->token     = $token;
        $this->initiator = $initiator;
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

    public function getInitiator(): ?string
    {
        return $this->initiator;
    }
}
