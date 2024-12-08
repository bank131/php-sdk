<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Request\Builder\Session\Multi;

use Bank131\SDK\API\Request\AbstractRequest;
use Bank131\SDK\API\Request\Builder\Session\AbstractSessionRequestBuilder;
use Bank131\SDK\API\Request\Session\InitMultiSessionRequest;
use Bank131\SDK\API\Request\Session\InitPayoutSessionRequest;
use Bank131\SDK\DTO\CustomRouting;
use Bank131\SDK\DTO\PaymentDetails;
use Bank131\SDK\DTO\PaymentOptions;
use Bank131\SDK\Exception\InvalidArgumentException;

final class InitMultiSessionRequestBuilder extends AbstractSessionRequestBuilder
{

    /**
     * @var PaymentOptions|null
     */
    protected $paymentOptions;

    /**
     * @var PaymentDetails[]
     */
    private $paymentDetailsMulti = [];

    /**
     * @var PaymentDetails[]
     */
    private $payoutDetailsMulti = [];

    /**
     * @psalm-suppress PossiblyNullArgument
     *
     * @return InitMultiSessionRequest
     */
    public function build(): AbstractRequest
    {
        $this->validate();

        $request = new InitMultiSessionRequest(
            $this->paymentDetailsMulti, $this->payoutDetailsMulti, $this->amount
        );

        if ($this->paymentDetailsMulti) {
            $request->setPaymentDetailsMulti($this->paymentDetailsMulti);
        }

        if ($this->payoutDetailsMulti) {
            $request->setPayoutDetailsMulti($this->payoutDetailsMulti);
        }

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

        if ($this->paymentOptions) {
            $request->setPaymentOptions($this->paymentOptions);
        }

        return $request;
    }

    public function setPaymentDetailsMulti(array $paymentDetailsMulti): self
    {
        $this->paymentDetailsMulti = $paymentDetailsMulti;

        return $this;
    }

    public function addPaymentDetails(PaymentDetails $paymentDetails): self
    {
        $this->paymentDetailsMulti[] = $paymentDetails;

        return $this;
    }

    public function addPayoutDetails(PaymentDetails $payoutDetails): self
    {
        $this->payoutDetailsMulti[] = $payoutDetails;

        return $this;
    }

    public function setPayoutDetailsMulti(array $payoutDetailsMulti): self
    {
        $this->payoutDetailsMulti = $payoutDetailsMulti;

        return $this;
    }

    public function setPaymentOptions(?PaymentOptions $paymentOptions): self
    {
        $this->paymentOptions = $paymentOptions;

        return $this;
    }

    protected function validate(): void
    {
        if (!$this->payoutDetailsMulti) {
            throw new InvalidArgumentException('You must specify payout details');
        }

        if (!$this->paymentDetailsMulti) {
            throw new InvalidArgumentException('You must specify payment details');
        }

        if (!$this->amount) {
            throw new InvalidArgumentException('You must specify amount');
        }
    }
}
