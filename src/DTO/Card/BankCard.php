<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\Card;

use Bank131\SDK\Exception\InvalidArgumentException;
use DateTime;

class BankCard extends AbstractCard
{
    /**
     * @var string
     */
    protected $number;

    /**
     * @var string|null
     */
    protected $expiration_month;

    /**
     * @var string|null
     */
    protected $expiration_year;

    /**
     * @var string|null
     */
    protected $security_code;

    /**
     * @var string|null
     */
    protected $cardholder_name;

    /**
     * BankCard constructor.
     *
     * @param string      $number
     * @param string|null $expirationMonth
     * @param string|null $expirationYear
     * @param string|null $securityCode
     * @param string|null $cardholderName
     */
    public function __construct(
        string $number,
        ?string $expirationMonth = null,
        ?string $expirationYear = null,
        ?string $securityCode = null,
        ?string $cardholderName = null
    ) {
        if (!preg_match('/^\d{14,19}$/', $number)) {
            throw new InvalidArgumentException('Card number must be between 14 and 19 digits');
        }

        $this->number = $number;

        if ($expirationMonth) {
            $this->setExpirationMonth($expirationMonth);
        }

        if ($expirationYear) {
            $this->setExpirationYear($expirationYear);
        }

        if ($securityCode) {
            $this->setSecurityCode($securityCode);
        }

        if ($cardholderName) {
            $this->setCardholderName($cardholderName);
        }
    }

    /**
     * @param string $expirationMonth
     */
    public function setExpirationMonth(string $expirationMonth): void
    {
        if (!preg_match('/^([0]\d|[1][0-2])$/', $expirationMonth)) {
            throw new InvalidArgumentException('Expiration month must be two digits');
        }

        $this->expiration_month = $expirationMonth;
    }

    /**
     * @param string $expirationYear
     */
    public function setExpirationYear(string $expirationYear): void
    {
        if (!preg_match('/^\d\d$/', $expirationYear)) {
            throw new InvalidArgumentException('Expiration year must be two digits');
        }

        $this->expiration_year = $expirationYear;
    }

    /**
     * @param string $securityCode
     */
    public function setSecurityCode(string $securityCode): void
    {
        if (!preg_match('/^\d{3,4}$/', $securityCode)) {
            throw new InvalidArgumentException('Security code must be three digits');
        }

        $this->security_code = $securityCode;
    }

    /**
     * @param string $cardholder_name
     */
    public function setCardholderName(string $cardholder_name): void
    {
        $this->cardholder_name = $cardholder_name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return CardEnum::BANK_CARD;
    }
}
