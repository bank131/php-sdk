<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO;

use Bank131\SDK\DTO\Collection\RejectReasonCollection;

class Error
{
    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $code;

    /**
     * @var RejectReasonCollection|null
     */
    private $reject_reasons;

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return RejectReasonCollection
     */
    public function getRejectReasons(): RejectReasonCollection
    {
        return $this->reject_reasons ?? new RejectReasonCollection();
    }
}