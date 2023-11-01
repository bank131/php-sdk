<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Request\Builder\Session\Payment;

use Bank131\SDK\API\Request\Builder\Session\AbstractSessionRequestBuilder;
use Bank131\SDK\DTO\BankAccount\AbstractBankAccount;
use Bank131\SDK\DTO\Card\AbstractCard;
use Bank131\SDK\DTO\CryptoWallet\AbstractCryptoWallet;
use Bank131\SDK\DTO\InternetBanking\AbstractInternetBanking;
use Bank131\SDK\DTO\PaymentDetails;
use Bank131\SDK\DTO\PaymentMethod\BankAccountPaymentMethod;
use Bank131\SDK\DTO\PaymentMethod\CardPaymentMethod;
use Bank131\SDK\DTO\PaymentMethod\CryptoWalletPaymentMethod;
use Bank131\SDK\DTO\PaymentMethod\FasterPaymentSystemPaymentMethod;
use Bank131\SDK\DTO\PaymentMethod\InternetBankingPaymentMethod;
use Bank131\SDK\DTO\PaymentMethod\RecurrentPaymentMethod;
use Bank131\SDK\DTO\PaymentMethod\SecuredCardPaymentMethod;
use Bank131\SDK\DTO\PaymentOptions;
use Bank131\SDK\DTO\SecuredCard\AbstractSecuredCard;

abstract class AbstractPaymentSessionRequestBuilder extends AbstractSessionRequestBuilder
{
    /**
     * @var PaymentDetails|null
     */
    protected $paymentDetails;

    /**
     * @var PaymentOptions|null
     */
    protected $paymentOptions;

    /**
     * @var array|null
     */
    protected $paymentMetadata;

    /**
     * @param PaymentOptions $paymentOptions
     *
     * @return $this
     */
    public function setPaymentOptions(PaymentOptions $paymentOptions): self
    {
        $this->paymentOptions = $paymentOptions;

        return $this;
    }

    /**
     * @param AbstractCard $card
     *
     * @return AbstractSessionRequestBuilder
     */
    public function setCard(AbstractCard $card): AbstractSessionRequestBuilder
    {
        $paymentDetails = new PaymentDetails(
            new CardPaymentMethod($card)
        );

        $this->paymentDetails = $paymentDetails;

        return $this;
    }

    /**
     * @param string      $token
     * @param string|null $initiator
     *
     * @return $this
     */
    public function setRecurrentToken(string $token, ?string $initiator = null, ?string $securityCode = null): self
    {
        $paymentDetails = new PaymentDetails(
            new RecurrentPaymentMethod($token, $initiator, $securityCode)
        );

        $this->paymentDetails = $paymentDetails;

        return $this;
    }

    /**
     * @param AbstractSecuredCard $securedCard
     *
     * @return $this
     */
    public function setSecuredCard(AbstractSecuredCard $securedCard): self
    {
        $paymentDetails = new PaymentDetails(
            new SecuredCardPaymentMethod($securedCard)
        );

        $this->paymentDetails = $paymentDetails;

        return $this;
    }

    /**
     * @param AbstractCryptoWallet $wallet
     *
     * @return $this
     */
    public function setCryptoWallet(AbstractCryptoWallet $wallet): self
    {
        $paymentDetails = new PaymentDetails(
            new CryptoWalletPaymentMethod($wallet)
        );

        $this->paymentDetails = $paymentDetails;

        return $this;
    }

    /**
     * @experimental
     * @return $this
     */
    public function setBankAccount(AbstractBankAccount $bankAccount): AbstractSessionRequestBuilder
    {
        $paymentDetails = new PaymentDetails(new BankAccountPaymentMethod($bankAccount));

        $this->paymentDetails = $paymentDetails;

        return $this;
    }

    public function makeFasterPaymentSystem(): self
    {
        $paymentDetails = new PaymentDetails(
            new FasterPaymentSystemPaymentMethod()
        );

        $this->paymentDetails = $paymentDetails;

        return $this;
    }

    public function setInternetBanking(AbstractInternetBanking $internetBanking): AbstractSessionRequestBuilder
    {
        $paymentDetails = new PaymentDetails(
            new InternetBankingPaymentMethod($internetBanking)
        );

        $this->paymentDetails = $paymentDetails;

        return $this;
    }

    public function setPaymentMetadata(array $paymentMetadata): self
    {
        $this->paymentMetadata = $paymentMetadata;

        return $this;
    }
}
