<?php

declare(strict_types=1);

namespace Bank131\SDK;

class Config
{
    /**
     * @var string
     */
    private $uri;

    /**
     * @var string
     */
    private $projectId;

    /**
     * @var string
     */
    private $privateKey;

    /**
     * @var string|null
     */
    private $bank131PublicKey;

    /**
     * Config constructor.
     *
     * @param string      $uri
     * @param string      $projectId
     * @param string      $privateKey
     * @param string|null $bank131PublicKey
     */
    public function __construct(string $uri, string $projectId, string $privateKey, ?string $bank131PublicKey = null)
    {
        $this->uri        = $uri;
        $this->projectId  = $projectId;
        $this->privateKey = $privateKey;
        $this->bank131PublicKey = $bank131PublicKey;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @return string
     */
    public function getProjectId(): string
    {
        return $this->projectId;
    }

    /**
     * @return string
     */
    public function getPrivateKey(): string
    {
        return $this->privateKey;
    }

    /**
     * @return bool
     */
    public function hasBank131PublicKey(): bool
    {
        return $this->bank131PublicKey !== null;
    }

    /**
     * @return string|null
     */
    public function getBank131PublicKey(): ?string
    {
        return $this->bank131PublicKey;
    }
}