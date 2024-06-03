<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\CustomerInteraction;

class QrInform
{
    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $img;

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getImg(): string
    {
        return $this->img;
    }
}
