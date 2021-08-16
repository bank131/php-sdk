<?php

declare(strict_types=1);

namespace Bank131\SDK;

class Version
{
    private const VERSION = '0.13.0';

    public static function getVersion(): string
    {
        return sprintf('bank131/php-sdk:%s, PHP/%s', self::VERSION, PHP_VERSION);
    }
}
