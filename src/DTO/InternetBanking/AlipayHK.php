<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\InternetBanking;

class AlipayHK extends AbstractInternetBanking
{
    public function getType(): string
    {
        return InternetBankingEnum::ALIPAY_HK;
    }
}
