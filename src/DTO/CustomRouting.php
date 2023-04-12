<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO;

class CustomRouting
{
    /**
     * @var CustomRoutingTag[]
     */
    private $tags;

    public function __construct(array $tags)
    {
        $this->tags = $tags;
    }
}
