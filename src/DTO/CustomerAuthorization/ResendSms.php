<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\CustomerAuthorization;

use DateTimeImmutable;

class ResendSms
{
    /**
     * @var int
     */
    private $restOfAttempts;

    /**
     * @var DateTimeImmutable
     */
    private $allowedFrom;

    /**
     * @var string
     */
    private $callbackUrl;

    public function __construct(
        int $restOfAttempts,
        DateTimeImmutable $allowedFrom,
        string $callbackUrl
    ) {
        $this->restOfAttempts = $restOfAttempts;
        $this->allowedFrom = $allowedFrom;
        $this->callbackUrl = $callbackUrl;
    }

    public function getRestOfAttempts(): int
    {
        return $this->restOfAttempts;
    }

    public function getAllowedFrom(): DateTimeImmutable
    {
        return $this->allowedFrom;
    }

    public function getCallbackUrl(): string
    {
        return $this->callbackUrl;
    }
}
