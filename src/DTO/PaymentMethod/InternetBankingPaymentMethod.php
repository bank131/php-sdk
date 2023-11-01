<?php
declare(strict_types=1);

namespace Bank131\SDK\DTO\PaymentMethod;

use Bank131\SDK\DTO\InternetBanking\AbstractInternetBanking;
use Bank131\SDK\DTO\InternetBanking\SberPay;
use Bank131\SDK\Exception\InvalidArgumentException;

class InternetBankingPaymentMethod extends PaymentMethod
{
    /**
     * @var string $type
     */
    private $type;
    /**
     * @var SberPay|null
     */
    private $sber_pay = null;

    public function __construct(AbstractInternetBanking $internetBanking)
    {
        if (!property_exists($this, $internetBanking->getType())) {
            throw new InvalidArgumentException('Invalid internet banking type');
        }

        $this->type          = $internetBanking->getType();
        $this->{$this->type} = $internetBanking;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getSberPay(): ?SberPay
    {
        return $this->sber_pay;
    }
}