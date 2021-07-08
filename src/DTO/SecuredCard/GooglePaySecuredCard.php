<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\SecuredCard;

class GooglePaySecuredCard extends AbstractSecuredCard
{
    /**
     * @var string
     */
    private $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return SecuredCardEnum::GOOGLE_PAY;
    }

    public function getToken(): string
    {
        return $this->token;
    }
}
