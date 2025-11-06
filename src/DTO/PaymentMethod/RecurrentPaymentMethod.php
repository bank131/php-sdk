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
     * @var string|null
     */
    private $security_code;

    /**
     * RecurrentPaymentMethod constructor.
     *
     * @param string      $token
     * @param string|null $initiator
     * @param string|null $securityCode
     */
    public function __construct(string $token, ?string $initiator = null, ?string $securityCode = null)
    {
        $this->token         = $token;
        $this->initiator     = $initiator;
        $this->security_code = $securityCode;
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
    public function getPaymentMethodType(): string
    {
        return PaymentMethodEnum::RECURRENT;
    }

    public function getInitiator(): ?string
    {
        return $this->initiator;
    }

    public function getSecurityCode(): ?string
    {
        return $this->security_code;
    }
}
