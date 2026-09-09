<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\CustomerInteraction\Inform;

class QRInform
{
    /**
     * @var string|null
     */
    private $content;

    /**
     * @var string|null
     */
    private $img;

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }
}
