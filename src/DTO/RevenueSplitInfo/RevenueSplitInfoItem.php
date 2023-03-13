<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\RevenueSplitInfo;

use Bank131\SDK\DTO\Amount;

/**
 * @experimental
 */
class RevenueSplitInfoItem
{
    /**
     * @var string
     */
    private $contractor_alias;

    /**
     * @var string|null
     */
    private $percent;

    /**
     * @var bool|null
     */
    private $remains;

    /**
     * @var Amount|null
     */
    private $amount;

    public function __construct(string $contractorAlias, ?string $percent, bool $remains = false)
    {
        $this->contractor_alias = $contractorAlias;
        $this->percent          = $percent;
        $this->remains          = $remains;
    }

    public function getContractorAlias(): string
    {
        return $this->contractor_alias;
    }

    public function getPercent(): ?string
    {
        return $this->percent;
    }

    public function getRemains(): ?bool
    {
        return $this->remains;
    }

    public function getAmount(): ?Amount
    {
        return $this->amount;
    }
}
