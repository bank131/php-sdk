<?php

declare(strict_types=1);

namespace Bank131\SDK\API;

use Bank131\SDK\API\Enum\ApiVersionEnum;
use Bank131\SDK\API\Enum\HeaderEnum;
use Bank131\SDK\API\Enum\HttpVerbEnum;
use Bank131\SDK\API\Request\AbstractRequest;
use Bank131\SDK\API\Request\Confirm\ConfirmInformation;
use Bank131\SDK\API\Request\Session\CapturePaymentSessionRequest;
use Bank131\SDK\API\Request\Session\ChargebackPaymentSessionRequest;
use Bank131\SDK\API\Request\Session\ConfirmRequest;
use Bank131\SDK\API\Request\Session\CreateSessionRequest;
use Bank131\SDK\API\Request\Session\InitPaymentSessionRequest;
use Bank131\SDK\API\Request\Session\InitPayoutSessionRequest;
use Bank131\SDK\API\Request\Session\InitPayoutSessionWithFiscalizationRequest;
use Bank131\SDK\API\Request\Session\RefundPaymentSessionRequest;
use Bank131\SDK\API\Request\Session\SessionIdRequest;
use Bank131\SDK\API\Request\Session\StartPaymentSessionRequest;
use Bank131\SDK\API\Request\Session\StartPayoutSessionRequest;
use Bank131\SDK\API\Request\Session\StartPayoutSessionRequestWithFiscalization;
use Bank131\SDK\API\Response\AbstractResponse;
use Bank131\SDK\API\Response\Session\SessionResponse;
use Bank131\SDK\DTO\Amount;
use GuzzleHttp\Exception\GuzzleException;

class SessionApi extends AbstractApi
{
    protected const BASE_URI = 'api/%s/session';

    private $apiVersion = ApiVersionEnum::V2;

    public function setToV1(): void
    {
        $this->apiVersion = ApiVersionEnum::V1;
    }

    /**
     * @param InitPaymentSessionRequest $request
     *
     * @return SessionResponse
     */
    public function initPayment(InitPaymentSessionRequest $request): SessionResponse
    {
        /** @var SessionResponse $response */
        $response = $this->request(
            HttpVerbEnum::POST,
            self::BASE_URI . '/init/payment',
            SessionResponse::class,
            $request
        );

        return $response;
    }

    /**
     * @param InitPayoutSessionRequest $request
     *
     * @return SessionResponse
     */
    public function initPayout(InitPayoutSessionRequest $request): SessionResponse
    {
        if ($this->apiVersion == ApiVersionEnum::V1) {
            $request = $request->createV1Version();
        }

        /** @var SessionResponse $response */
        $response = $this->request(
            HttpVerbEnum::POST,
            self::BASE_URI . '/init/payout',
            SessionResponse::class,
            $request
        );

        return $response;
    }

    /**
     * @param InitPayoutSessionWithFiscalizationRequest $request
     *
     * @return SessionResponse
     */
    public function initPayoutWithFiscalization(InitPayoutSessionWithFiscalizationRequest $request): SessionResponse
    {
        if ($this->apiVersion == ApiVersionEnum::V1) {
            $request = $request->createV1Version();
        }

        /** @var SessionResponse $response */
        $response = $this->request(
            HttpVerbEnum::POST,
            self::BASE_URI . '/init/payout/fiscalization',
            SessionResponse::class,
            $request
        );

        return $response;
    }

    /**
     * @param CreateSessionRequest $request
     *
     * @return SessionResponse
     */
    public function create(CreateSessionRequest $request): SessionResponse
    {
        /** @var SessionResponse $response */
        $response = $this->request(
            HttpVerbEnum::POST,
            self::BASE_URI . '/create',
            SessionResponse::class,
            $request
        );

        return $response;
    }

    /**
     * @param StartPaymentSessionRequest $request
     *
     * @return SessionResponse
     */
    public function startPayment(StartPaymentSessionRequest $request): SessionResponse
    {
        /** @var SessionResponse $response */
        $response = $this->request(
            HttpVerbEnum::POST,
            self::BASE_URI . '/start/payment',
            SessionResponse::class,
            $request
        );

        return $response;
    }

    /**
     * @param StartPayoutSessionRequest $request
     *
     * @return SessionResponse
     */
    public function startPayout(StartPayoutSessionRequest $request): SessionResponse
    {
        /** @var SessionResponse $response */
        $response = $this->request(
            HttpVerbEnum::POST,
            self::BASE_URI . '/start/payout',
            SessionResponse::class,
            $request
        );

        return $response;
    }

    /**
     * @param StartPayoutSessionRequestWithFiscalization $request
     *
     * @return SessionResponse
     */
    public function startPayoutWithFiscalization(StartPayoutSessionRequestWithFiscalization $request): SessionResponse
    {
        /** @var SessionResponse $response */
        $response = $this->request(
            HttpVerbEnum::POST,
            self::BASE_URI . '/start/payout/fiscalization',
            SessionResponse::class,
            $request
        );

        return $response;
    }

    /**
     * @param RefundPaymentSessionRequest $request
     *
     * @return SessionResponse
     */
    public function refund(RefundPaymentSessionRequest $request): SessionResponse
    {
        /** @var SessionResponse $response */
        $response = $this->request(
            HttpVerbEnum::POST,
            self::BASE_URI . '/refund',
            SessionResponse::class,
            $request
        );

        return $response;
    }

    public function chargeback(ChargebackPaymentSessionRequest $request): SessionResponse
    {
        /** @var SessionResponse $response */
        $response = $this->request(
            HttpVerbEnum::POST,
            self::BASE_URI . '/chargeback',
            SessionResponse::class,
            $request
        );

        return $response;
    }

    /**
     * @param string $sessionId
     *
     * @return SessionResponse
     */
    public function confirm(string $sessionId, ?ConfirmInformation $confirmInformation = null): SessionResponse
    {
        if (
            $this->apiVersion === ApiVersionEnum::V1
            && $confirmInformation !== null
            && ($transferDetails = $confirmInformation->getTransferDetails()) !== null
        ) {
            $confirmInformation = new ConfirmInformation(
                $transferDetails->createV1Version(),
                $confirmInformation->getExchanges(),
                $confirmInformation->getAccountDetails()
            );
        }

        $request = new ConfirmRequest($sessionId, $confirmInformation);

        /** @var SessionResponse $response */
        $response = $this->request(
            HttpVerbEnum::POST,
            self::BASE_URI . '/confirm',
            SessionResponse::class,
            $request
        );

        return $response;
    }

    /**
     * @param string $sessionId
     *
     * @return SessionResponse
     */
    public function cancel(string $sessionId): SessionResponse
    {
        $request = new SessionIdRequest($sessionId);

        /** @var SessionResponse $response */
        $response = $this->request(
            HttpVerbEnum::POST,
            self::BASE_URI . '/cancel',
            SessionResponse::class,
            $request
        );

        return $response;
    }

    /**
     * @param string $sessionId
     *
     * @return SessionResponse
     */
    public function capture(string $sessionId): SessionResponse
    {
        $request = new SessionIdRequest($sessionId);

        /** @var SessionResponse $response */
        $response = $this->request(
            HttpVerbEnum::POST,
            self::BASE_URI . '/capture',
            SessionResponse::class,
            $request
        );

        return $response;
    }

    public function capturePayment(CapturePaymentSessionRequest $request): SessionResponse
    {
        /** @var SessionResponse $response */
        $response = $this->request(
            HttpVerbEnum::POST,
            self::BASE_URI . '/capture',
            SessionResponse::class,
            $request
        );

        return $response;
    }

    /**
     * @param string $sessionId
     *
     * @return SessionResponse
     */
    public function status(string $sessionId): SessionResponse
    {
        $request = new SessionIdRequest($sessionId);

        /** @var SessionResponse $response */
        $response = $this->request(
            HttpVerbEnum::POST,
            self::BASE_URI . '/status',
            SessionResponse::class,
            $request
        );

        return $response;
    }

    public function withIdempotencyKey(string $key): SessionApi
    {
        return $this->withHeader(HeaderEnum::IDEMPOTENCY_KEY, $key);
    }

    protected function request(
        string $method,
        string $uri,
        string $expectedClass,
        AbstractRequest $request = null
    ): AbstractResponse {
        return parent::request(
            $method,
            sprintf($uri, $this->apiVersion),
            $expectedClass,
            $request
        );
    }
}
