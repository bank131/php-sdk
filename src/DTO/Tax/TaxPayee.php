<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\Tax;

class TaxPayee
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
    private $account_eks;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $kpp;

    /**
     * @var string
     */
    private $inn;

    public function __construct(
        string $bik,
        string $account,
        string $accountEks,
        string $name,
        string $kpp,
        string $inn
    ){
        $this->bik = $bik;
        $this->account = $account;
        $this->account_eks = $accountEks;
        $this->name = $name;
        $this->kpp = $kpp;
        $this->inn = $inn;
    }

    public function getBik(): string
    {
        return $this->bik;
    }

    public function getAccount(): string
    {
        return $this->account;
    }

    public function getAccountEks(): string
    {
        return $this->account_eks;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getKpp(): string
    {
        return $this->kpp;
    }

    public function getInn(): string
    {
        return $this->inn;
    }
}
