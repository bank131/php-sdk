<?php
declare(strict_types=1);

namespace Bank131\SDK\DTO\CryptoWallet;

abstract class AbstractCryptoWallet
{
    /**
     * @return string
     */
    abstract public function getType(): string;
}
