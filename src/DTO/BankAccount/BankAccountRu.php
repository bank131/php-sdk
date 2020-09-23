<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\BankAccount;

class BankAccountRu extends AbstractBankAccount
{
    /**
     * @var string
     */
    private $bik;

    /**
     * @var string
     */
    private $account;

    /**
     * @var string
     */
    private $full_name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var bool
     */
    private $is_fast;

    /**
     * BankAccountRu constructor.
     *
     * @param string $bik
     * @param string $account
     * @param string $fullName
     * @param string $description
     * @param bool   $isFast
     */
    public function __construct(
        string $bik,
        string $account,
        string $fullName,
        string $description,
        bool $isFast = false
    ) {
        $this->bik         = $bik;
        $this->account     = $account;
        $this->full_name   = $fullName;
        $this->description = $description;
        $this->is_fast     = $isFast;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
       return BankAccountEnum::RU;
    }
}