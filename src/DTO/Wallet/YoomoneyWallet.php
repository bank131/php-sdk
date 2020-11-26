<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\Wallet;

class YoomoneyWallet extends AbstractWallet
{
    /**
     * @var string
     */
    private $account;


    public function __construct(string $account)
    {
        $this->account = $account;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return WalletEnum::YOOMONEY;
    }
}
