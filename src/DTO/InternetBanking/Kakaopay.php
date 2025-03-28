<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\InternetBanking;

class Kakaopay extends AbstractInternetBanking
{
    public function getType(): string
    {
        return InternetBankingEnum::KAKAOPAY;
    }
}
