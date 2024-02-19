<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\BankAccount;

abstract class AbstractBankAccountRuFps extends AbstractBankAccount
{
    /**
     * @var string
     */
    protected $phone;

    /**
     * @var string
     */
    protected $bank_id;

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getBankId(): string
    {
        return $this->bank_id;
    }

    public function __construct(string $phone, string $bankId)
    {
        $this->phone   = $phone;
        $this->bank_id = $bankId;
    }
}