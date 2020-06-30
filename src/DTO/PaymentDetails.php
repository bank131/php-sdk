<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO;

use Bank131\SDK\DTO\PaymentMethod\BankAccountPaymentMethod;
use Bank131\SDK\DTO\PaymentMethod\CardPaymentMethod;
use Bank131\SDK\DTO\PaymentMethod\PaymentMethod;
use Bank131\SDK\DTO\PaymentMethod\WalletPaymentMethod;

class PaymentDetails
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var CardPaymentMethod|null
     */
    private $card;

    /**
     * @var WalletPaymentMethod|null
     */
    private $wallet;

    /**
     * @var BankAccountPaymentMethod|null
     */
    private $bank_account;

    /**
     * @var
     */
    private $recurrent;

    /**
     * PaymentDetails constructor.
     *
     * @param PaymentMethod $paymentMethod
     */
    public function __construct(PaymentMethod $paymentMethod)
    {
        $this->type = $paymentMethod->getType();
        $this->{$this->type} = $paymentMethod;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return CardPaymentMethod|null
     */
    public function getCard(): ?CardPaymentMethod
    {
        return $this->card;
    }
}