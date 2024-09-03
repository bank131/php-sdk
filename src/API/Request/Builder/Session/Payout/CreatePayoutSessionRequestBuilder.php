<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Request\Builder\Session\Payout;

use Bank131\SDK\API\Request\AbstractRequest;
use Bank131\SDK\API\Request\Session\CreateSessionRequest;
use Bank131\SDK\DTO\CustomRouting;

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

        if ($this->payoutDetails) {
            $request->setPayoutDetails($this->payoutDetails);
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