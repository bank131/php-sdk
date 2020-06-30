<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Request\Wallet;

use Bank131\SDK\API\Request\AbstractRequest;
use DateTimeImmutable;

class WalletBalanceRequest extends AbstractRequest
{
    /**
     * @var DateTimeImmutable
     */
    private $request_datetime;

    /**
     * WalletBalanceRequest constructor.
     *
     * @param DateTimeImmutable|null $dateTime
     */
    public function __construct(DateTimeImmutable $dateTime = null)
    {
        $this->request_datetime = $dateTime ?? new DateTimeImmutable();
    }
}