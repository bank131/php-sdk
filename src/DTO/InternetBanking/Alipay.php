<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\InternetBanking;

class Alipay extends AbstractInternetBanking
{
    /**
     * @var string $device
     */
    private $device;

    public function __construct(string $device)
    {
        $this->device = $device;
    }

    public function getType(): string
    {
        return InternetBankingEnum::ALIPAY;
    }

    public function getDevice(): string
    {
        return $this->device;
    }
}
