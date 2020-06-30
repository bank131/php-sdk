<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Response\Wallet;

use Bank131\SDK\API\Response\AbstractResponse;
use Bank131\SDK\DTO\Collection\WalletDetailsCollection;

class WalletBalanceResponse extends AbstractResponse
{
    /**
     * @var WalletDetailsCollection|null
     */
    private $wallets;

    /**
     * @return WalletDetailsCollection
     */
    public function getWallets(): WalletDetailsCollection
    {
        return $this->wallets ?? new WalletDetailsCollection();
    }
}