<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Response;

use Bank131\SDK\API\Response\Enum\ResponseStatusEnum;

abstract class AbstractResponse
{
    /**
     * @var string
     */
    protected $status;

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    public function isOk(): bool
    {
        return $this->status === ResponseStatusEnum::OK;
    }
}