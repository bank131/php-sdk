<?php

declare(strict_types=1);

namespace Bank131\SDK;

class Config
{
    private const DEFAULT_TIMEOUT_IN_SECONDS = 30;

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
     * @var int
     */
    private $connectTimeout = self::DEFAULT_TIMEOUT_IN_SECONDS;

    /**
     * @var int
     */
    private $timeout = self::DEFAULT_TIMEOUT_IN_SECONDS;

    /**
     * Config constructor.
     *
     * @param string      $uri
     * @param string      $projectId
     * @param string      $privateKey
     * @param string|null $bank131PublicKey
     * @param int         $timeout
     * @param int         $connectTimeout
     */
    public function __construct(
        string $uri,
        string $projectId,
        string $privateKey,
        ?string $bank131PublicKey = null,
        int $timeout = self::DEFAULT_TIMEOUT_IN_SECONDS,
        int $connectTimeout = self::DEFAULT_TIMEOUT_IN_SECONDS
    ) {
        $this->uri              = $uri;
        $this->projectId        = $projectId;
        $this->privateKey       = $privateKey;
        $this->bank131PublicKey = $bank131PublicKey;
        $this->timeout          = $timeout;
        $this->connectTimeout   = $connectTimeout;
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

    /**
     * @return int
     */
    public function getConnectTimeout(): int
    {
        return $this->connectTimeout;
    }

    /**
     * @return int
     */
    public function getTimeout(): int
    {
        return $this->timeout;
    }
}