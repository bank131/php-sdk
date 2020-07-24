<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Request;

use Bank131\SDK\Exception\InvalidArgumentException;

abstract class AbstractRequest
{
    /**
     * Validate value is scalar, array or null
     *
     * @param $value
     *
     * @internal
     */
    final protected function validateScalarOrArray($value): void
    {
        if (!(is_scalar($value) || is_array($value) || $value === null)) {
            throw new InvalidArgumentException('Value must be null, scalar or array');
        }
    }
}
