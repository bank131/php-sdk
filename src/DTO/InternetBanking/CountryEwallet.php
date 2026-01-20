<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\InternetBanking;

final class CountryEwallet extends AbstractInternetBanking
{
    /**
     * @var string $country
     */
    private $country;

    public function __construct(
        string $country
    ) {
        $this->country = $country;
    }

    public function getType(): string
    {
        return InternetBankingEnum::COUNTRY_EWALLET;
    }

    public function getCountry(): string
    {
        return $this->country;
    }
}
