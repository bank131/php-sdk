<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\BankAccount;

abstract class AbstractBankAccount
{
    /**
     * @return string
     */
    abstract public function getType(): string;
}