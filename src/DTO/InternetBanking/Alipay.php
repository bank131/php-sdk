<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\InternetBanking;

class Alipay extends AbstractInternetBanking
{
    /**
     * @var string $protocol
     */
    private $protocol;

    public function __construct(string $protocol)
    {
        $this->protocol = $protocol;
    }

    public function getType(): string
    {
        return InternetBankingEnum::ALIPAY;
    }

    public function getProtocol(): string
    {
        return $this->protocol;
    }
}
