<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO;

use Bank131\SDK\Exception\InvalidArgumentException;

class PaymentOptions
{
    /**
     * @var string|null
     */
    private $return_url;

    /**
     * @var bool|null
     */
    private $recurrent;

    /**
     * @var Subscription|null
     */
    private $subscription;

    /**
     * @param string $returnUrl
     */
    public function setReturnUrl(string $returnUrl): void
    {
        if (filter_var($returnUrl, FILTER_VALIDATE_URL) === false) {
            throw new InvalidArgumentException('Return url parameter must be a valid url');
        }

        $this->return_url = $returnUrl;
    }

    /**
     * @return string|null
     */
    public function getReturnUrl(): ?string
    {
        return $this->return_url;
    }

    /**
     * @return bool|null
     */
    public function getRecurrent(): ?bool
    {
        return $this->recurrent;
    }

    /**
     * @param bool $recurrent
     */
    public function setRecurrent(bool $recurrent): void
    {
        $this->recurrent = $recurrent;
    }

    /**
     * @return bool
     */
    public function isRecurrent(): bool
    {
        return $this->recurrent === true;
    }

    /**
     * @return Subscription|null
     */
    public function getSubscription(): ?Subscription
    {
        return $this->subscription;
    }

    /**
     * @param Subscription $subscription
     */
    public function setSubscription(Subscription $subscription): void
    {
        $this->subscription = $subscription;
    }

    public function isInitiatedBySubscription(): bool
    {
        return $this->subscription && $this->subscription->isNotInitial();
    }
}