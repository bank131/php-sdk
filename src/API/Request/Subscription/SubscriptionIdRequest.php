<?php
declare(strict_types=1);

namespace Bank131\SDK\API\Request\Subscription;

use Bank131\SDK\API\Request\AbstractRequest;

class SubscriptionIdRequest extends AbstractRequest
{
    /**
     * @var string
     */
    private $subscription_id;

    /**
     * @param string $subscriptionId
     */
    public function __construct(string $subscriptionId)
    {
        $this->subscription_id = $subscriptionId;
    }
}