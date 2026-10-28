<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\FasterPaymentSystem;

class SubscriptionServiceInfo
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    public function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}
