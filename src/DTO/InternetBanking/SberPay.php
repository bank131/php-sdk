<?php
declare(strict_types=1);

namespace Bank131\SDK\DTO\InternetBanking;

class SberPay extends AbstractInternetBanking
{
    /**
     * @var ?string $phone
     */
    private $phone;

    /**
     * @var string $channel
     */
    private $channel;

    public function __construct(string $channel, ?string $phone)
    {
        $this->channel = $channel;
        $this->phone = $phone;
    }

    public function getType(): string
    {
        return InternetBankingEnum::SBER_PAY;
    }

    function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getChannel(): string
    {
        return $this->channel;
    }
}