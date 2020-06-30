<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Request\Builder\Session\Payout;

use Bank131\SDK\API\Request\AbstractRequest;
use Bank131\SDK\API\Request\Session\CreateSessionRequest;

class CreatePayoutSessionRequestBuilder extends AbstractPayoutSessionRequestBuilder
{
    /**
     * @return CreateSessionRequest
     */
    public function build(): AbstractRequest
    {
        $request = new CreateSessionRequest();

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

        return $request;
    }
}