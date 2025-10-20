<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\Tax;

class TaxPayer
{
    /**
     * @var string
     */
    private $kpp;

    /**
     * @var string
     */
    private $inn;

    public function __construct(string $kpp, string $inn)
    {
        $this->kpp = $kpp;
        $this->inn = $inn;
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
