<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Request\Builder\Session\Payout;

use Bank131\SDK\API\Request\AbstractRequest;
use Bank131\SDK\API\Request\Session\StartPayoutSessionRequestWithFiscalization;
use Bank131\SDK\DTO\CustomRouting;
use Bank131\SDK\DTO\FiscalizationDetails;

final class StartPayoutSessionWithFiscalizationRequestBuilder extends AbstractPayoutSessionRequestBuilder
{
    /**
     * @var string
     */
    private $sessionId;

    /**
     * StartSessionWithFiscalizationRequestBuilder constructor.
     *
     * @param string               $sessionId
     * @param FiscalizationDetails $fiscalizationDetails
     */
    public function __construct(string $sessionId, FiscalizationDetails $fiscalizationDetails)
    {
        $this->sessionId = $sessionId;
        $this->fiscalizationDetails = $fiscalizationDetails;
    }

    /**
     * @psalm-suppress PossiblyNullArgument
     *
     * @return StartPayoutSessionRequestWithFiscalization
     */
    public function build(): AbstractRequest
    {
        $request = new StartPayoutSessionRequestWithFiscalization($this->sessionId, $this->fiscalizationDetails);

        if ($this->amount) {
            $request->setAmount($this->amount);
        }

        if ($this->customer) {
            $request->setCustomer($this->customer);
        }

        if ($this->participantDetails) {
            $request->setParticipantDetails($this->participantDetails);
        }

        if ($this->metadata) {
            $request->setMetadata($this->metadata);
        }

        if ($this->paymentMethod) {
            $request->setPaymentMethod($this->paymentMethod);
        }

        if ($this->customRoutingTags) {
            $customRouting = new CustomRouting($this->customRoutingTags);
            $request->setCustomRouting($customRouting);
        }

        return $request;
    }
}