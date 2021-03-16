<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\BankAccount;

class BankAccountIban extends AbstractBankAccount
{
    /**
     * @var string
     */
    private $account;

    public function __construct(string $account)
    {
        $this->account = $account;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return BankAccountEnum::IBAN;
    }
}
