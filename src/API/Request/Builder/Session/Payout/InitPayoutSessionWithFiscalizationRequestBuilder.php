<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Request\Builder\Session\Payout;

use Bank131\SDK\API\Request\AbstractRequest;
use Bank131\SDK\API\Request\Session\InitPayoutSessionWithFiscalizationRequest;
use Bank131\SDK\DTO\CustomRouting;
use Bank131\SDK\Exception\InvalidArgumentException;

final class InitPayoutSessionWithFiscalizationRequestBuilder extends AbstractPayoutSessionRequestBuilder
{
    /**
     * @psalm-suppress PossiblyNullArgument
     *
     * @return InitPayoutSessionWithFiscalizationRequest
     */
    public function build(): AbstractRequest
    {
        $this->validate();

        $request = new InitPayoutSessionWithFiscalizationRequest(
            $this->payoutDetails, $this->amount, $this->participantDetails, $this->fiscalizationDetails
        );

        if ($this->customer) {
            $request->setCustomer($this->customer);
        }

        if ($this->metadata) {
            $request->setMetadata($this->metadata);
        }

        if ($this->customRoutingTags) {
            $customRouting = new CustomRouting($this->customRoutingTags);
            $request->setCustomRouting($customRouting);
        }

        return $request;
    }

    protected function validate(): void
    {
        if (!$this->fiscalizationDetails) {
            throw new InvalidArgumentException('You must specify fiscalization details');
        }

        if (!$this->payoutDetails) {
            throw new InvalidArgumentException('You must specify payment method (card/bank account/wallet)');
        }

        if (!$this->amount) {
            throw new InvalidArgumentException('You must specify amount');
        }

        if (!$this->participantDetails) {
            throw new InvalidArgumentException('You must specify participant details (sender/customer)');
        }

        if (!($this->participantDetails->getRecipient() && $this->participantDetails->getRecipient()->hasFullName())) {
            throw new InvalidArgumentException('You must specify recipient with full name');
        }
    }
}