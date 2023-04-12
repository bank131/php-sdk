<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Request\Builder\Session\Payment;

use Bank131\SDK\API\Request\AbstractRequest;
use Bank131\SDK\API\Request\Session\InitPaymentSessionRequest;
use Bank131\SDK\DTO\CustomRouting;
use Bank131\SDK\Exception\InvalidArgumentException;

final class InitPaymentSessionRequestBuilder extends AbstractPaymentSessionRequestBuilder
{
    /**
     * @psalm-suppress PossiblyNullArgument
     *
     * @return InitPaymentSessionRequest
     */
    public function build(): AbstractRequest
    {
        $this->validate();

        $request = new InitPaymentSessionRequest(
            $this->paymentDetails, $this->amount, $this->customer
        );

        if ($this->paymentOptions) {
            $request->setPaymentOptions($this->paymentOptions);
        }

        if ($this->metadata) {
            $request->setMetadata($this->metadata);
        }

        if ($this->participantDetails) {
            $request->setParticipantDetails($this->participantDetails);
        }

        if ($this->customRoutingTags) {
            $customRouting = new CustomRouting($this->customRoutingTags);
            $request->setCustomRouting($customRouting);
        }

        return $request;
    }

    protected function validate(): void
    {
        if (!$this->paymentDetails) {
            throw new InvalidArgumentException('You must specify card');
        }

        if (!$this->amount) {
            throw new InvalidArgumentException('You must specify amount');

        }

        if (!$this->customer) {
            throw new InvalidArgumentException('You must specify customer');
        }
    }
}