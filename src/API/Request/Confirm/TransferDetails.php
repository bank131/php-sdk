<?php
declare(strict_types=1);

namespace Bank131\SDK\API\Request\Confirm;

use Bank131\SDK\DTO\Amount;
use Bank131\SDK\DTO\PaymentMethod\PaymentMethod;

class TransferDetails
{
    /**
     * @var PaymentMethod
     */
    private $payout_details;

    /**
     * @var PaymentMethod
     */
    private $payment_method;

    /**
     * @var NominalPaymentParticipant
     */
    private $customer;

    /**
     * @var NominalPaymentParticipant
     */
    private $recipient;

    /**
     * @var string
     */
    private $purpose;

    /**
     * @var Amount
     */
    private $amount;

    public function __construct(
        NominalPaymentParticipant $customer,
        NominalPaymentParticipant $recipient,
        string                    $purpose,
        Amount                    $amount,
        PaymentMethod             $paymentMethod
    ) {
        $this->customer       = $customer;
        $this->recipient      = $recipient;
        $this->purpose        = $purpose;
        $this->amount         = $amount;
        $this->payout_details = $paymentMethod;
    }

    public function getPayoutDetails(): PaymentMethod
    {
        return $this->payout_details ?? $this->payment_method;
    }

    public function getCustomer(): NominalPaymentParticipant
    {
        return $this->customer;
    }

    public function getRecipient(): NominalPaymentParticipant
    {
        return $this->recipient;
    }

    public function getPurpose(): string
    {
        return $this->purpose;
    }

    public function getAmount(): Amount
    {
        return $this->amount;
    }

    public function createV1Version(): self
    {
        $new = clone $this;
        $new->payment_method = $this->getPayoutDetails();
        $new->payout_details = null;

        return $new;
    }
}
