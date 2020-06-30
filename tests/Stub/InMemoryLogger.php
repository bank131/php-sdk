<?php

declare(strict_types=1);

namespace Bank131\SDK\Tests\Stub;

use Psr\Log\LoggerInterface;

class InMemoryLogger implements LoggerInterface
{
    /**
     * @var array
     */
    private $log = [];

    /**
     * @inheritDoc
     */
    public function emergency($message, array $context = array()): void
    {
        $this->log[] = [$message, $context];
    }

    /**
     * @inheritDoc
     */
    public function alert($message, array $context = array()): void
    {
        $this->log[] = [$message, $context];
    }

    /**
     * @inheritDoc
     */
    public function critical($message, array $context = array()): void
    {
        $this->log[] = [$message, $context];
    }

    /**
     * @inheritDoc
     */
    public function error($message, array $context = array()): void
    {
        $this->log[] = [$message, $context];
    }

    /**
     * @inheritDoc
     */
    public function warning($message, array $context = array()): void
    {
        $this->log[] = [$message, $context];
    }

    /**
     * @inheritDoc
     */
    public function notice($message, array $context = array()): void
    {
        $this->log[] = [$message, $context];
    }

    /**
     * @inheritDoc
     */
    public function info($message, array $context = array()): void
    {
        $this->log[] = [$message, $context];
    }

    /**
     * @inheritDoc
     */
    public function debug($message, array $context = array()): void
    {
        $this->log[] = [$message, $context];
    }

    /**
     * @inheritDoc
     */
    public function log($level, $message, array $context = array()): void
    {
        $this->log[] = [$message, $context];
    }

    /**
     * @return array
     */
    public function getLog(): array
    {
        return $this->log;
    }
}