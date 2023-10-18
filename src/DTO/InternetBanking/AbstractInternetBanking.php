<?php
declare(strict_types=1);

namespace Bank131\SDK\DTO\InternetBanking;

abstract class AbstractInternetBanking
{
    abstract public function getType(): string;
}