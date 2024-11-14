<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Request\Session;

use Bank131\SDK\DTO\Amount;
use Bank131\SDK\DTO\PaymentDetails;

class InitMultiSessionRequest extends AbstractSessionRequest
{
    /**
     * @var PaymentDetails[]
     */
    protected $payment_details_multi = [];

    /**
     * @var PaymentDetails[]
     */
    protected $payout_details_multi = [];

    /**
     * @param PaymentDetails[] $paymentDetailsMulti
     * @param PaymentDetails[] $payoutDetailsMulti
     */
    public function __construct(array $paymentDetailsMulti, array $payoutDetailsMulti, Amount $amount)
    {
        $this->setPaymentDetailsMulti($paymentDetailsMulti);
        $this->setPayoutDetailsMulti($payoutDetailsMulti);
        $this->setAmount($amount);
    }

    public function setPaymentDetailsMulti(array $payment_details_multi): void
    {
        $this->payment_details_multi = $payment_details_multi;
    }

    public function setPayoutDetailsMulti(array $payout_details_multi): void
    {
        $this->payout_details_multi = $payout_details_multi;
    }
}