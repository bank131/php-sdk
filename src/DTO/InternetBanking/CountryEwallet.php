<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\InternetBanking;

final class CountryEwallet extends AbstractInternetBanking
{
    /**
     * @var string $country_iso2
     */
    private $country_iso2;

    public function __construct(
        string $country_iso2
    ) {
        $this->country_iso2 = $country_iso2;
    }

    public function getType(): string
    {
        return InternetBankingEnum::COUNTRY_EWALLET;
    }

    public function getCountryIso2(): string
    {
        return $this->country_iso2;
    }
}
