<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO;

class PlatformDetails
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var string|null
     */
    private $os;

    public function getType(): string
    {
        return $this->type;
    }

    public function getOs(): ?string
    {
        return $this->os;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function setOs(string $os): void
    {
        $this->os = $os;
    }
}
