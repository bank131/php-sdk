<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Request\Session;

use Bank131\SDK\DTO\Amount;
use Bank131\SDK\DTO\ParticipantDetails;
use Bank131\SDK\DTO\PaymentDetails;

class InitPayoutSessionRequest extends AbstractSessionRequest
{
    public function __construct(PaymentDetails $payoutDetails, Amount $amount, ParticipantDetails $participant)
    {
        $this->setPayoutDetails($payoutDetails);
        $this->setAmount($amount);
        $this->setParticipantDetails($participant);
    }
}