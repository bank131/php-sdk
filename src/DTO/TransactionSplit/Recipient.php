<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\TransactionSplit;

class Recipient
{
    /**
     * @var string
     */
    private $contractor_alias;

    /**
     * @var int
     */
    private $percent;

    /**
     * @var bool
     */
    private $remains;
}
