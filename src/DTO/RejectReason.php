<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO;

use DateTimeImmutable;

class RejectReason
{
    /**
     * @var string
     */
    private $rule_alias;

    /**
     * @var string|null
     */
    private $list_alias;

    /**
     * @var DateTimeImmutable|null
     */
    private $expiration_date;

    /**
     * @return string
     */
    public function getRuleAlias(): string
    {
        return $this->rule_alias;
    }

    /**
     * @return string|null
     */
    public function getListAlias(): ?string
    {
        return $this->list_alias;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getExpirationDate(): ?DateTimeImmutable
    {
        return $this->expiration_date;
    }
}