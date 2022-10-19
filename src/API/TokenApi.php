<?php
declare(strict_types=1);

namespace Bank131\SDK\API;

use Bank131\SDK\API\Enum\HttpVerbEnum;
use Bank131\SDK\API\Request\Subscription\SubscriptionIdRequest;
use Bank131\SDK\API\Request\Token\TokenInfoRequest;
use Bank131\SDK\API\Response\Subscription\SubscriptionResponse;
use Bank131\SDK\API\Response\Token\TokenInfoResponse;

class TokenApi extends AbstractApi
{
    protected const BASE_URI = 'api/v1/token';

    public function info(TokenInfoRequest $tokenInfoRequest): TokenInfoResponse
    {
        /** @var TokenInfoResponse $response */
        $response = $this->request(
            HttpVerbEnum::POST,
            self::BASE_URI . '/info',
            TokenInfoResponse::class,
            $tokenInfoRequest
        );

        return $response;
    }
}
