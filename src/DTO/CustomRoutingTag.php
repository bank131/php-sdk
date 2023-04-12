<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO;

class CustomRoutingTag
{
    /**
     * @var string
     */
    private $root_tag;

    /**
     * @var string[]
     */
    private $values;

    public function __construct(string $rootTag, array $values)
    {
        $this->root_tag = $rootTag;
        $this->values = $values;
    }
}
