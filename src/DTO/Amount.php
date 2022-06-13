<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO;

use Bank131\SDK\Exception\InvalidArgumentException;

class Amount
{
    /**
     * @var int
     */
    private $amount;

    /**
     * @var string
     */
    private $currency;

    /**
     * Amount constructor.
     *
     * @param int    $amount
     * @param string $currency
     */
    public function __construct(int $amount, string $currency)
    {
        if ($amount <= 0) {
            throw new InvalidArgumentException('Amount value must be greater than 0');
        }

        $this->amount   = $amount;
        $this->currency = $currency;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }
}
