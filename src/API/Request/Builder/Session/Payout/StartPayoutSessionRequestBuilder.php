<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Request\Builder\Session\Payout;

use Bank131\SDK\API\Request\AbstractRequest;
use Bank131\SDK\API\Request\Session\CreateSessionRequest;
use Bank131\SDK\API\Request\Session\StartPayoutSessionRequest;
use Bank131\SDK\DTO\CustomRouting;

class StartPayoutSessionRequestBuilder extends AbstractPayoutSessionRequestBuilder
{
    /**
     * @var string
     */
    private $sessionId;

    /**
     * StartPayoutSessionRequestBuilder constructor.
     *
     * @param string $sessionId
     */
    public function __construct(string $sessionId)
    {
        $this->sessionId = $sessionId;
    }

    /**
     * @return StartPayoutSessionRequest
     */
    public function build(): AbstractRequest
    {
        $request = new StartPayoutSessionRequest($this->sessionId);

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

        if ($this->fiscalizationDetails) {
            $request->setFiscalizationDetails($this->fiscalizationDetails);
        }

        if ($this->customRoutingTags) {
            $customRouting = new CustomRouting($this->customRoutingTags);
            $request->setCustomRouting($customRouting);
        }

        return $request;
    }
}