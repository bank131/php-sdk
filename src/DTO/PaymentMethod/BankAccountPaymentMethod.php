<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\PaymentMethod;

use Bank131\SDK\DTO\BankAccount\AbstractBankAccount;
use Bank131\SDK\DTO\BankAccount\BankAccountFPS;
use Bank131\SDK\DTO\BankAccount\BankAccountIban;
use Bank131\SDK\DTO\BankAccount\BankAccountRu;
use Bank131\SDK\DTO\BankAccount\BankAccountUpi;
use Bank131\SDK\DTO\PaymentMethod\Enum\PaymentMethodEnum;
use Bank131\SDK\Exception\InvalidArgumentException;

class BankAccountPaymentMethod extends PaymentMethod
{
    /**
     * @var string
     */
    private $system_type;

    /**
     * @var BankAccountRU|null
     */
    private $ru;

    /**
     * @var BankAccountIban|null
     */
    private $iban;

    /**
     * @var BankAccountUpi|null
     */
    private $upi;

    /**
     * @var BankAccountFPS
     */
    private $faster_payment_system;

    /**
     * BankAccountPaymentMethod constructor.
     *
     * @param AbstractBankAccount $bankAccount
     */
    public function __construct(AbstractBankAccount $bankAccount)
    {
        if (!property_exists($this, $bankAccount->getType())) {
            throw new InvalidArgumentException('Invalid bank account card');
        }

        $this->system_type          = $bankAccount->getType();
        $this->{$this->system_type} = $bankAccount;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return PaymentMethodEnum::BANK_ACCOUNT;
    }

    /**
     * @experimental
     */
    public function getUpi(): ?BankAccountUpi
    {
        return $this->upi;
    }

    public function getFasterPaymentSystem(): ?BankAccountFPS
    {
        return $this->faster_payment_system;
    }
}