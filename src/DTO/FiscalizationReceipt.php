<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO;

class FiscalizationReceipt
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string|null
     */
    private $link;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getLink(): ?string
    {
        return $this->link;
    }
}