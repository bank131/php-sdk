<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\Wallet;

class TelegramWallet extends AbstractWallet
{
    /**
     * @var string
     */
    private $account;

    public function __construct(string $account)
    {
        $this->account = $account;
    }

    public function getType(): string
    {
        return WalletEnum::TELEGRAM;
    }
}
