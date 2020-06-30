<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Request\Builder;

use Bank131\SDK\API\Request\Builder\Session\Payment\CreatePaymentSessionRequestBuilder;
use Bank131\SDK\API\Request\Builder\Session\Payment\InitPaymentSessionRequestBuilder;
use Bank131\SDK\API\Request\Builder\Session\Payment\StartPaymentSessionRequestBuilder;
use Bank131\SDK\API\Request\Builder\Session\Payout\CreatePayoutSessionRequestBuilder;
use Bank131\SDK\API\Request\Builder\Session\Payout\InitPayoutSessionRequestBuilder;
use Bank131\SDK\API\Request\Builder\Session\Payout\InitPayoutSessionWithFiscalizationRequestBuilder;
use Bank131\SDK\API\Request\Builder\Session\Payout\StartPayoutSessionRequestBuilder;
use Bank131\SDK\API\Request\Builder\Session\Payout\StartPayoutSessionWithFiscalizationRequestBuilder;
use Bank131\SDK\API\Request\Builder\Session\RefundSessionRequestBuilder;
use Bank131\SDK\API\Request\Builder\Widget\IssuePublicTokenBuilder;
use Bank131\SDK\DTO\FiscalizationDetails;
use Bank131\SDK\DTO\ProfessionalIncomeTaxpayer;

final class RequestBuilderFactory
{
    /**
     * @return static
     */
    public static function create(): self
    {
        return new self();
    }

    /**
     * @return InitPaymentSessionRequestBuilder
     */
    public function initPaymentSession(): InitPaymentSessionRequestBuilder
    {
        return new InitPaymentSessionRequestBuilder();
    }

    /**
     * @return InitPayoutSessionRequestBuilder
     */
    public function initPayoutSession(): InitPayoutSessionRequestBuilder
    {
        return new InitPayoutSessionRequestBuilder();
    }

    /**
     * @return InitPayoutSessionWithFiscalizationRequestBuilder
     */
    public function initPayoutSessionWithFiscalization(): InitPayoutSessionWithFiscalizationRequestBuilder
    {
        return new InitPayoutSessionWithFiscalizationRequestBuilder();
    }

    /**
     * @return CreatePaymentSessionRequestBuilder
     */
    public function createPaymentSession(): CreatePaymentSessionRequestBuilder
    {
        return new CreatePaymentSessionRequestBuilder();
    }

    /**
     * @return CreatePayoutSessionRequestBuilder
     */
    public function createPayoutSession(): CreatePayoutSessionRequestBuilder
    {
        return new CreatePayoutSessionRequestBuilder();
    }

    /**
     * @param string $sessionId
     *
     * @return StartPaymentSessionRequestBuilder
     */
    public function startPaymentSession(string $sessionId): StartPaymentSessionRequestBuilder
    {
        return new StartPaymentSessionRequestBuilder($sessionId);
    }

    /**
     * @param string $sessionId
     *
     * @return StartPayoutSessionRequestBuilder
     */
    public function startPayoutSession(string $sessionId): StartPayoutSessionRequestBuilder
    {
        return new StartPayoutSessionRequestBuilder($sessionId);
    }

    /**
     * @param string                     $sessionId
     * @param ProfessionalIncomeTaxpayer $incomeTaxpayer
     *
     * @return StartPayoutSessionWithFiscalizationRequestBuilder
     */
    public function startPayoutSessionWithFiscalization(
        string $sessionId,
        ProfessionalIncomeTaxpayer $incomeTaxpayer
    ): StartPayoutSessionWithFiscalizationRequestBuilder {
        return new StartPayoutSessionWithFiscalizationRequestBuilder(
            $sessionId,
            new FiscalizationDetails($incomeTaxpayer)
        );
    }

    /**
     * @param string $sessionId
     *
     * @return RefundSessionRequestBuilder
     */
    public function refundSession(string $sessionId): RefundSessionRequestBuilder
    {
        return new RefundSessionRequestBuilder($sessionId);
    }

    /**
     * @return IssuePublicTokenBuilder
     */
    public function issuePublicTokenBuilder(): IssuePublicTokenBuilder
    {
        return new IssuePublicTokenBuilder();
    }
}
