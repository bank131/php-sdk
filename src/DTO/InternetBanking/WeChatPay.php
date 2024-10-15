<?php
declare(strict_types=1);

namespace Bank131\SDK\DTO\InternetBanking;

class WeChatPay extends AbstractInternetBanking
{
    public function getType(): string
    {
        return InternetBankingEnum::WECHATPAY;
    }
}
