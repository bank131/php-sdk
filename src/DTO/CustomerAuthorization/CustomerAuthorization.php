<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\CustomerAuthorization;

abstract class CustomerAuthorization
{
    /**
     * @see CustomerAuthorizationEnum
     * @var string
     */
    protected $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
