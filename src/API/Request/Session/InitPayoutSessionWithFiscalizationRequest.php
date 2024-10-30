<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Request\Session;

use Bank131\SDK\DTO\Amount;
use Bank131\SDK\DTO\FiscalizationDetails;
use Bank131\SDK\DTO\ParticipantDetails;
use Bank131\SDK\DTO\PaymentDetails;

class InitPayoutSessionWithFiscalizationRequest extends InitPayoutSessionRequest
{

    /**
     * @var FiscalizationDetails
     */
    private $fiscalization_details;

    /**
     * InitPayoutSessionWithFiscalizationRequest constructor.
     *
     * @param PaymentDetails       $payoutDetails
     * @param Amount               $amount
     * @param ParticipantDetails   $participant
     * @param FiscalizationDetails $fiscalizationDetails
     */
    public function __construct(
        PaymentDetails $payoutDetails,
        Amount $amount,
        ParticipantDetails $participant,
        FiscalizationDetails $fiscalizationDetails
    ) {
        parent::__construct($payoutDetails, $amount, $participant);

        $this->fiscalization_details = $fiscalizationDetails;
    }
}