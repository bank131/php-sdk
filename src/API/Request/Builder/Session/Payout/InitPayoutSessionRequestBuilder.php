<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Request\Builder\Session\Payout;

use Bank131\SDK\API\Request\AbstractRequest;
use Bank131\SDK\API\Request\Session\InitPayoutSessionRequest;
use Bank131\SDK\DTO\CustomRouting;
use Bank131\SDK\Exception\InvalidArgumentException;

final class InitPayoutSessionRequestBuilder extends AbstractPayoutSessionRequestBuilder
{
    /**
     * @psalm-suppress PossiblyNullArgument
     *
     * @return InitPayoutSessionRequest
     */
    public function build(): AbstractRequest
    {
        $this->validate();

        $request = new InitPayoutSessionRequest(
            $this->payoutDetails, $this->amount, $this->participantDetails
        );

        if ($this->customer) {
            $request->setCustomer($this->customer);
        }

        if ($this->metadata) {
            $request->setMetadata($this->metadata);
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

    protected function validate(): void
    {
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