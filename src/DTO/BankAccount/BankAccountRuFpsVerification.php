<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\BankAccount;

class BankAccountRuFpsVerification extends AbstractBankAccountRuFps
{
    public function getType(): string
    {
        return BankAccountEnum::FASTER_PAYMENT_SYSTEM_VERIFICATION;
    }
}