<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\SecuredCard;

class ApplePaySecuredCard extends AbstractSecuredCard
{
    /**
     * @var string
     */
    private $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function getType(): string
    {
        return SecuredCardEnum::APPLE_PAY;
    }

    public function getToken(): string
    {
        return $this->token;
    }
}
