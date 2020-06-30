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
     * BankAccountRu constructor.
     *
     * @param string $bik
     * @param string $account
     * @param string $full_name
     * @param string $description
     */
    public function __construct(string $bik, string $account, string $full_name, string $description)
    {
        $this->bik         = $bik;
        $this->account     = $account;
        $this->full_name   = $full_name;
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
       return BankAccountEnum::RU;
    }
}