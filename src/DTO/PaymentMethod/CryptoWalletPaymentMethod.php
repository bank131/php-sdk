<?php
declare(strict_types=1);

namespace Bank131\SDK\DTO\PaymentMethod;

use Bank131\SDK\DTO\CryptoWallet\AbstractCryptoWallet;
use Bank131\SDK\DTO\CryptoWallet\TonCryptoWallet;
use Bank131\SDK\DTO\PaymentMethod\Enum\PaymentMethodEnum;
use Bank131\SDK\Exception\InvalidArgumentException;

class CryptoWalletPaymentMethod extends PaymentMethod
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var TonCryptoWallet|null
     */
    private $ton = null;

    public function __construct(AbstractCryptoWallet $wallet)
    {
        if (!property_exists($this, $wallet->getType())) {
            throw new InvalidArgumentException('Invalid crypto wallet type');
        }

        $this->type          = $wallet->getType();
        $this->{$this->type} = $wallet;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getPaymentMethodType(): string
    {
        return PaymentMethodEnum::CRYPTO_WALLET;
    }

    public function getTon(): ?TonCryptoWallet
    {
        return $this->ton;
    }
}
