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
     * QiwiAbstractWallet constructor.
     *
     * @param string $account
     */
    public function __construct(string $account)
    {
        $this->account = $account;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return WalletEnum::QIWI;
    }
}