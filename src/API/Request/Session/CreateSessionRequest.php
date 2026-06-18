<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Request\Session;

use Bank131\SDK\DTO\ParticipantDetails;
use Bank131\SDK\DTO\PaymentDetails;

class CreateSessionRequest extends AbstractSessionRequest
{
    public function getPayoutDetails(): PaymentDetails
    {
        return parent::getPayoutDetails();
    }

    public function getParticipantDetails(): ParticipantDetails
    {
        return parent::getParticipantDetails();
    }
}