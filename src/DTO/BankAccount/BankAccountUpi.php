<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\BankAccount;

/**
 * @experimental
 */
class BankAccountUpi extends AbstractBankAccount
{
    /**
     * @return string
     */
    public function getType(): string
    {
       return BankAccountEnum::UPI;
    }
}