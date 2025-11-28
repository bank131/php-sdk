<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\PlatformDetails;

use Bank131\SDK\DTO\PlatformDetails\Enum\BrowserEnum;
use Bank131\SDK\DTO\PlatformDetails\Enum\OsEnum;
use Bank131\SDK\DTO\PlatformDetails\Enum\PlatformTypeEnum;

class PlatformDetails
{
    /**
     * @see PlatformTypeEnum
     *
     * @var string
     */
    private $type;

    /**
     * @see OsEnum
     *
     * @var string|null
     */
    private $os;

    /**
     * @see BrowserEnum
     *
     * @var string|null
     */
    private $browser;

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

    public function getBrowser(): ?string
    {
        return $this->browser;
    }

    public function setBrowser(string $browser): void
    {
        $this->browser = $browser;
    }
}
