<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\InternetBanking;

class CUP extends AbstractInternetBanking
{
    public function getType(): string
    {
        return InternetBankingEnum::CUP;
    }
}
