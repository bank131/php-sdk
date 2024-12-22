<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Request\Builder\Session\Multi;

use Bank131\SDK\API\Request\AbstractRequest;
use Bank131\SDK\API\Request\Builder\AbstractBuilder;
use Bank131\SDK\API\Request\Builder\Session\Payment\InitPaymentSessionRequestBuilder;
use Bank131\SDK\API\Request\Builder\Session\Payout\InitPayoutSessionRequestBuilder;
use Bank131\SDK\API\Request\Session\InitMultiSessionRequest;
use Bank131\SDK\DTO\Collection\PaymentRequestCollection;
use Bank131\SDK\DTO\Collection\PayoutRequestCollection;
use Bank131\SDK\Exception\InvalidArgumentException;

final class InitMultiSessionRequestBuilder extends AbstractBuilder
{
    /**
     * @var InitPaymentSessionRequestBuilder[]
     */
    private $paymentRequestBuilderList = [];

    /**
     * @var InitPayoutSessionRequestBuilder[]
     */
    private $payoutRequestBuilderList = [];

    /**
     * @return InitMultiSessionRequest
     */
    public function build(): AbstractRequest
    {
        $this->validate();

        $paymentList = [];
        $payoutList = [];

        foreach ($this->paymentRequestBuilderList as $paymentRequestBuilder) {
            $paymentList[] = $paymentRequestBuilder->build();
        }

        foreach ($this->payoutRequestBuilderList as $payoutRequestBuilder) {
            $payoutList[] = $payoutRequestBuilder->build();
        }

        return new InitMultiSessionRequest(
            new PaymentRequestCollection($paymentList),
            new PayoutRequestCollection($payoutList)
        );
    }

    private function validate(): void
    {
        if (!$this->paymentRequestBuilderList) {
            throw new InvalidArgumentException('You must specify payment request builder(s)');
        }

        if (!$this->payoutRequestBuilderList) {
            throw new InvalidArgumentException('You must specify payout request builder(s)');
        }
    }

    public function addPaymentRequestBuilder(InitPaymentSessionRequestBuilder $builder): self
    {
        $this->paymentRequestBuilderList[] = $builder;

        return $this;
    }

    public function addPayoutRequestBuilder(InitPayoutSessionRequestBuilder $builder): self
    {
        $this->payoutRequestBuilderList[] = $builder;

        return $this;
    }
}
