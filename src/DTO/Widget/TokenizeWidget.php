<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\Widget;

class TokenizeWidget
{
    /**
     * @var bool
     */
    private $access;

    /**
     * TokenizeWidget constructor.
     *
     * @param bool $access
     */
    public function __construct(bool $access = true)
    {
        $this->access = $access;
    }
}