<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\PaymentMethod;

use Bank131\SDK\DTO\FasterPaymentSystem\SubscriptionServiceInfo;

abstract class AbstractFPSPaymentMethod extends PaymentMethod
{
    /**
     * @var SubscriptionServiceInfo|null
     */
    protected $subscription_service_info;

    public function __construct(?SubscriptionServiceInfo $subscriptionServiceInfo = null)
    {
        $this->subscription_service_info = $subscriptionServiceInfo;
    }
}
