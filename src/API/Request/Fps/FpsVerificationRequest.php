<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Request\Fps;

use Bank131\SDK\API\Request\Session\AbstractSessionRequest;
use Bank131\SDK\DTO\ParticipantDetails;
use Bank131\SDK\DTO\PaymentDetails;

class FpsVerificationRequest extends AbstractSessionRequest
{
    public function __construct(
        string $sessionId,
        PaymentDetails $paymentDetails,
        ParticipantDetails $participantDetails
    ) {
        $this->setSessionId($sessionId);
        $this->setPayoutDetails($paymentDetails);
        $this->setParticipantDetails($participantDetails);
    }

    public function createV1Version(): self
    {
        return parent::createV1();
    }
}