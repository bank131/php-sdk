<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\Card;

abstract class AbstractCard
{
    /**
     * @return string
     */
    abstract public function getType(): string;
}