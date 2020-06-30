<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\Widget;

use Bank131\SDK\Exception\InvalidArgumentException;

class SelfEmployedWidget
{
    /**
     * @var string
     */
    private $tax_reference;

    /**
     * SelfEmployedWidget constructor.
     *
     * @param string $taxReference
     */
    public function __construct(string $taxReference)
    {
        if (!preg_match('/^\d{12}$/', $taxReference)) {
            throw new InvalidArgumentException('Tax reference value must be a number 12 digits long');
        }

        $this->tax_reference = $taxReference;
    }
}