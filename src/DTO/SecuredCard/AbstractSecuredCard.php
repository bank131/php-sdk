<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\SecuredCard;

abstract class AbstractSecuredCard
{
    /**
     * @return string
     */
    abstract public function getType(): string;
}
