<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Request\Builder\Session\Payout;

use Bank131\SDK\API\Request\Builder\Session\AbstractSessionRequestBuilder;
use Bank131\SDK\DTO\BankAccount\AbstractBankAccount;
use Bank131\SDK\DTO\Card\AbstractCard;
use Bank131\SDK\DTO\FiscalizationDetails;
use Bank131\SDK\DTO\PaymentDetails;
use Bank131\SDK\DTO\PaymentMethod\BankAccountPaymentMethod;
use Bank131\SDK\DTO\PaymentMethod\CardPaymentMethod;
use Bank131\SDK\DTO\PaymentMethod\WalletPaymentMethod;
use Bank131\SDK\DTO\ProfessionalIncomeTaxpayer;
use Bank131\SDK\DTO\Wallet\AbstractWallet;

abstract class AbstractPayoutSessionRequestBuilder extends AbstractSessionRequestBuilder
{
    /**
     * @var PaymentDetails|null
     */
    protected $paymentMethod;

    /**
     * @var FiscalizationDetails|null
     */
    protected $fiscalizationDetails;

    /**
     * @param AbstractCard $card
     *
     * @return $this
     */
    public function setCard(AbstractCard $card): AbstractSessionRequestBuilder
    {
        $paymentMethod = new PaymentDetails(
            new CardPaymentMethod($card)
        );

        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    /**
     * @param AbstractWallet $wallet
     *
     * @return $this|AbstractSessionRequestBuilder
     */
    public function setWallet(AbstractWallet $wallet): AbstractSessionRequestBuilder
    {
        $paymentMethod = new PaymentDetails(
            new WalletPaymentMethod($wallet)
        );

        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    /**
     * @param AbstractBankAccount $bankAccount
     *
     * @return $this|AbstractSessionRequestBuilder
     */
    public function setBankAccount(AbstractBankAccount $bankAccount): AbstractSessionRequestBuilder
    {
        $paymentMethod = new PaymentDetails(
            new BankAccountPaymentMethod($bankAccount)
        );

        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    /**
     * @param ProfessionalIncomeTaxpayer $professionalIncomeTaxpayer
     *
     * @return $this
     */
    public function setIncomeInformation(ProfessionalIncomeTaxpayer $professionalIncomeTaxpayer): self
    {
        $fiscalizationDetails = new FiscalizationDetails(
            $professionalIncomeTaxpayer
        );

        $this->fiscalizationDetails = $fiscalizationDetails;

        return $this;
    }
}