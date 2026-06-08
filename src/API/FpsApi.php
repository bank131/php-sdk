<?php

declare(strict_types=1);

namespace Bank131\SDK\API;

use Bank131\SDK\API\Enum\ApiVersionEnum;
use Bank131\SDK\API\Enum\HttpVerbEnum;
use Bank131\SDK\API\Request\AbstractRequest;
use Bank131\SDK\API\Request\Fps\FpsVerificationRequest;
use Bank131\SDK\API\Response\AbstractResponse;
use Bank131\SDK\API\Response\Fps\FpsBanksListResponse;
use Bank131\SDK\API\Response\Fps\FpsVerificationResponse;
use Bank131\SDK\API\Response\Session\SessionResponse;

class FpsApi extends AbstractApi
{
    protected const BASE_URI = 'api/%s/fps';

    private $apiVersion = ApiVersionEnum::V2;

    public function setToV1(): void
    {
        $this->apiVersion = ApiVersionEnum::V1;
    }

    public function getBanks(): FpsBanksListResponse
    {
        /** @var FpsBanksListResponse $response */
        $response = $this->request(
            HttpVerbEnum::GET,
            self::BASE_URI . '/banks',
            FpsBanksListResponse::class
        );

        return $response;
    }

    public function verification(
        FpsVerificationRequest $request
    ): SessionResponse {
        if ($this->apiVersion === ApiVersionEnum::V1) {
            $request = $request->createV1Version();
        }

        /** @var SessionResponse $response */
        $response = $this->request(
            HttpVerbEnum::POST,
            self::BASE_URI . '/customer_verification',
            SessionResponse::class,
            $request
        );

        return $response;
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
