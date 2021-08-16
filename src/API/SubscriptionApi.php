<?php
declare(strict_types=1);

namespace Bank131\SDK\API;

use Bank131\SDK\API\Enum\HttpVerbEnum;
use Bank131\SDK\API\Request\Subscription\SubscriptionIdRequest;
use Bank131\SDK\API\Response\Session\SessionResponse;
use Bank131\SDK\API\Response\Subscription\SubscriptionResponse;

class SubscriptionApi extends AbstractApi
{
    protected const BASE_URI = 'api/v1/subscription';

    /**
     * @param string $subscriptionId
     *
     * @return SubscriptionResponse
     */
    public function cancel(string $subscriptionId): SubscriptionResponse
    {
        $request = new SubscriptionIdRequest($subscriptionId);

        /** @var SubscriptionResponse $response */
        $response = $this->request(
            HttpVerbEnum::POST,
            self::BASE_URI . '/cancel',
            SubscriptionResponse::class,
            $request
        );

        return $response;
    }
}