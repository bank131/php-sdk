<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\TransactionSplit;

class TransactionSplitInfo
{
    /**
     * @var Recipient[]
     */
    private $revenue_split_info;

    /**
     * @param Recipient[] $revenueSplitInfo
     */
    public function __construct(array $revenueSplitInfo)
    {
        $this->revenue_split_info = $revenueSplitInfo;
    }
}
