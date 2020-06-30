<?php

declare(strict_types=1);

namespace Bank131\SDK\Helper;

use ReflectionClass;

abstract class BaseEnum
{
    /**
     * Return all constants for class
     *
     * @return array
     */
    public static function all(): array
    {
        $reflection = new ReflectionClass(static::class);

        return $reflection->getConstants();
    }
}