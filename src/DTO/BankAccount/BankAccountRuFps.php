<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\BankAccount;

class BankAccountRuFps extends AbstractBankAccountRuFps
{
    /**
     * @var string|null
     */
    protected $description;

    public function __construct(string $phone, string $bankId, ?string $description = null)
    {
        parent::__construct($phone, $bankId);
        $this->description = $description;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getType(): string
    {
        return BankAccountEnum::FASTER_PAYMENT_SYSTEM;
    }
}