<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO;

use Bank131\SDK\DTO\Enum\CurrencyEnum;
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

        if (!$this->isCurrencyValid($currency)) {
            throw new InvalidArgumentException(
                'Currency value must be one of: ' . implode(', ', CurrencyEnum::all())
            );
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

    /**
     * @psalm-suppress MixedAssignment
     * @psalm-suppress MixedArgument
     *
     * @param string $currency
     *
     * @return bool
     */
    private function isCurrencyValid(string $currency): bool
    {
        foreach (CurrencyEnum::all() as $existentCurrency) {
            if (strcasecmp($currency, $existentCurrency) === 0) {
                return true;
            }
        }

        return false;
    }
}