<?php
declare(strict_types=1);

namespace Bank131\SDK\DTO\CryptoWallet;

class TonCryptoWallet extends AbstractCryptoWallet
{
    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $product_id;

    /**
     * @var string
     */
    private $product_name;

    public function __construct(string $address, string $product_id, string $product_name)
    {
        $this->address      = $address;
        $this->product_id   = $product_id;
        $this->product_name = $product_name;
    }

    public function getType(): string
    {
        return CryptoWalletEnum::TON;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getProductId(): string
    {
        return $this->product_id;
    }

    public function getProductName(): string
    {
        return $this->product_name;
    }
}
