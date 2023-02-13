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
     * @param Recipient[] $revenue_split_info
     */
    public function __construct(array $revenue_split_info)
    {
        $this->revenue_split_info = $revenue_split_info;
    }
}
