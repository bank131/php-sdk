<?php
declare(strict_types=1);

namespace Bank131\SDK\DTO\InternetBanking;

final class TamaraPayment extends AbstractInternetBanking
{
    public function getType(): string
    {
        return InternetBankingEnum::TAMARA;
    }
}
