<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Request\Builder\Session\Payment;

use Bank131\SDK\API\Request\AbstractRequest;
use Bank131\SDK\API\Request\Session\CreateSessionRequest;

final class CreatePaymentSessionRequestBuilder extends AbstractPaymentSessionRequestBuilder
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

        if ($this->paymentDetails) {
            $request->setPaymentDetails($this->paymentDetails);
        }

        if ($this->paymentOptions) {
            $request->setPaymentOptions($this->paymentOptions);
        }

        if ($this->revenueSplitInfo) {
            $request->setRevenueSplitInfo($this->revenueSplitInfo);
        }

        return $request;
    }
}