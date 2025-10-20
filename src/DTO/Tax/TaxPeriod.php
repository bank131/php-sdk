<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\Tax;

class TaxPeriod
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var int
     */
    private $number;

    /**
     * @var string
     */
    private $year;

    public function __construct(string $type, int $number, string $year)
    {
        $this->type = $type;
        $this->number = $number;
        $this->year = $year;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function getYear(): string
    {
        return $this->year;
    }
}
