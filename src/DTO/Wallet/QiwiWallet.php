<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\Wallet;

class QiwiWallet extends AbstractWallet
{
    /**
     * @var string
     */
    private $account;

    /**
     * @var string|null
     */
    private $description;

    public function __construct(string $account, ?string $description = null)
    {
        $this->account     = $account;
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return WalletEnum::QIWI;
    }
}