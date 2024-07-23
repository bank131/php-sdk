<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\CustomerAuthorization;

class Error
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $message;

    public function __construct(
        string $code,
        string $message
    ) {
        $this->code    = $code;
        $this->message = $message;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
