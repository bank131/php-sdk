<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\PaymentMethod;

use Bank131\SDK\DTO\PaymentMethod\Enum\PaymentMethodEnum;
use Bank131\SDK\DTO\Wallet\AbstractWallet;
use Bank131\SDK\DTO\Wallet\QiwiWallet;
use Bank131\SDK\DTO\Wallet\SteamWallet;
use Bank131\SDK\DTO\Wallet\YoomoneyWallet;
use Bank131\SDK\Exception\InvalidArgumentException;

class WalletPaymentMethod extends PaymentMethod
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var QiwiWallet|null
     */
    private $qiwi;

    /**
     * @var YoomoneyWallet|null
     */
    private $yoomoney;

    /**
     * @var SteamWallet|null
     */
    private $steam;

    /**
     * WalletPaymentMethod constructor.
     *
     * @param AbstractWallet $wallet
     */
    public function __construct(AbstractWallet $wallet)
    {
        if (!property_exists($this, $wallet->getType())) {
            throw new InvalidArgumentException('Invalid wallet type');
        }

        $this->type          = $wallet->getType();
        $this->{$this->type} = $wallet;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    public function getPaymentMethodType(): string
    {
        return PaymentMethodEnum::WALLET;
    }
}
