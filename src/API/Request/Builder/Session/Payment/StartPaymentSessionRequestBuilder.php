<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Request\Builder\Session\Payment;

use Bank131\SDK\API\Request\AbstractRequest;
use Bank131\SDK\API\Request\Session\StartPaymentSessionRequest;
use Bank131\SDK\DTO\CustomRouting;

final class StartPaymentSessionRequestBuilder extends AbstractPaymentSessionRequestBuilder
{
    /**
     * @var string
     */
    private $sessionId;

    /**
     * StartSessionRequestBuilder constructor.
     *
     * @param string $sessionId
     */
    public function __construct(string $sessionId)
    {
        $this->sessionId = $sessionId;
    }

    /**
     * @return StartPaymentSessionRequest
     */
    public function build(): AbstractRequest
    {
        $request = new StartPaymentSessionRequest($this->sessionId);

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

        if ($this->paymentDetails) {
            $request->setPaymentDetails($this->paymentDetails);
        }

        if ($this->paymentOptions) {
            $request->setPaymentOptions($this->paymentOptions);
        }

        if ($this->customRoutingTags) {
            $customRouting = new CustomRouting($this->customRoutingTags);
            $request->setCustomRouting($customRouting);
        }

        return $request;
    }
}