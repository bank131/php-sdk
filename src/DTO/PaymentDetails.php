<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO;

use Bank131\SDK\DTO\PaymentMethod\BankAccountPaymentMethod;
use Bank131\SDK\DTO\PaymentMethod\CardPaymentMethod;
use Bank131\SDK\DTO\PaymentMethod\CryptoWalletPaymentMethod;
use Bank131\SDK\DTO\PaymentMethod\FasterPaymentSystemPaymentMethod;
use Bank131\SDK\DTO\PaymentMethod\InternetBankingPaymentMethod;
use Bank131\SDK\DTO\PaymentMethod\PaymentMethod;
use Bank131\SDK\DTO\PaymentMethod\RecurrentPaymentMethod;
use Bank131\SDK\DTO\PaymentMethod\SecuredCardPaymentMethod;
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
     * @var RecurrentPaymentMethod|null
     */
    private $recurrent;

    /**
     * @var SecuredCardPaymentMethod|null
     */
    private $secured_card;

    /**
     * @var CryptoWalletPaymentMethod|null
     */
    private $crypto_wallet;

    /**
     * @var InternetBankingPaymentMethod|null
     */
    private $internet_banking;

    /**
     * @var FasterPaymentSystemPaymentMethod|null
     */
    private $faster_payment_system;

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

    public function getWallet(): ?WalletPaymentMethod
    {
        return $this->wallet;
    }

    public function getBankAccount(): ?BankAccountPaymentMethod
    {
        return $this->bank_account;
    }

    public function getRecurrent(): ?RecurrentPaymentMethod
    {
        return $this->recurrent;
    }

    public function getSecuredCard(): ?SecuredCardPaymentMethod
    {
        return $this->secured_card;
    }

    public function getCryptoWallet(): ?CryptoWalletPaymentMethod
    {
        return $this->crypto_wallet;
    }

    public function getInternetBanking(): ?InternetBankingPaymentMethod
    {
        return $this->internet_banking;
    }

    public function getFasterPaymentSystem(): ?FasterPaymentSystemPaymentMethod
    {
        return $this->faster_payment_system;
    }
}
