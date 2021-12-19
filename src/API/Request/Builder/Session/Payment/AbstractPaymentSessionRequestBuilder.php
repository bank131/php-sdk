<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Request\Builder\Session\Payment;

use Bank131\SDK\API\Request\Builder\Session\AbstractSessionRequestBuilder;
use Bank131\SDK\DTO\Card\AbstractCard;
use Bank131\SDK\DTO\CryptoWallet\AbstractCryptoWallet;
use Bank131\SDK\DTO\PaymentDetails;
use Bank131\SDK\DTO\PaymentMethod\CardPaymentMethod;
use Bank131\SDK\DTO\PaymentMethod\CryptoWalletPaymentMethod;
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
     * @param string $token
     *
     * @return $this
     */
    public function setRecurrentToken(string $token): self
    {
        $paymentDetails = new PaymentDetails(
            new RecurrentPaymentMethod($token)
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
}
