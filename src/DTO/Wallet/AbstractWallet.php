<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\Wallet;

abstract class AbstractWallet
{
    /**
     * @return string
     */
    abstract public function getType(): string;
}