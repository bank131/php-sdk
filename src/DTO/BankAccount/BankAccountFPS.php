<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\BankAccount;

class BankAccountFPS extends AbstractBankAccount
{
    /**
     * @var string|null
     */
    private $phone;

    /**
     * @var string|null
     */
    private $bank_id;

    /**
     * @var string|null
     */
    private $description;


    public function __construct(
      ?string $phone = null,
      ?string $bankId = null,
      ?string $description = null
    ) {
        $this->phone = $phone;
        $this->bank_id = $bankId;
        $this->description = $description;
    }

    public function getType(): string
    {
        return 'faster_payment_system';
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getBankId(): ?string
    {
        return $this->bank_id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }
}
