<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\CustomerAuthorization;

use DateTimeImmutable;

class AcceptCode
{
    /**
     * @var int
     */
    private $restOfAttempts;

    /**
     * @var DateTimeImmutable
     */
    private $activeTo;

    /**
     * @var string
     */
    private $callbackUrl;

    public function __construct(
        int $restOfAttempts,
        DateTimeImmutable $activeTo,
        string $callbackUrl
    ) {
        $this->restOfAttempts = $restOfAttempts;
        $this->activeTo = $activeTo;
        $this->callbackUrl = $callbackUrl;
    }

    public function getRestOfAttempts(): int
    {
        return $this->restOfAttempts;
    }

    public function getActiveTo(): DateTimeImmutable
    {
        return $this->activeTo;
    }

    public function getCallbackUrl(): string
    {
        return $this->callbackUrl;
    }
}
