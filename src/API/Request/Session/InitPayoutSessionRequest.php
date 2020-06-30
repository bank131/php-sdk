<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Request\Session;

use Bank131\SDK\DTO\Amount;
use Bank131\SDK\DTO\ParticipantDetails;
use Bank131\SDK\DTO\PaymentDetails;

class InitPayoutSessionRequest extends AbstractSessionRequest
{
    public function __construct(PaymentDetails $paymentMethod, Amount $amount, ParticipantDetails $participant)
    {
        $this->setPaymentMethod($paymentMethod);
        $this->setAmount($amount);
        $this->setParticipantDetails($participant);
    }
}