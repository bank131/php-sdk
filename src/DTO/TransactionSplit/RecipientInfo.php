<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\TransactionSplit;

abstract class RecipientInfo
{
    /**
     * @var string
     */
    private $uuid;

    /**
     * @var int
     */
    private $contractId;
}
