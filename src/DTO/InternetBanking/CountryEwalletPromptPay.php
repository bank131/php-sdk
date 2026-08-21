<?php

declare(strict_types = 1);

namespace Bank131\SDK\DTO\InternetBanking;

final class CountryEwalletPromptPay extends CountryEwallet
{
    public function getSubtype(): string
    {
        return InternetBankingEnum::COUNTRY_EWALLET_PROMPTPAY;
    }
}
