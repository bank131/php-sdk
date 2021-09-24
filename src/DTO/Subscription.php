<?php
declare(strict_types=1);

namespace Bank131\SDK\DTO;

use DateTimeImmutable;

class Subscription
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $period;

    /**
     * @var bool|null
     */
    private $initial;

    /**
     * @var DateTimeImmutable|null
     */
    private $next_point;

    /**
     * @var bool|null
     */
    private $retries_exceeded;

    /**
     * Subscription constructor.
     *
     * @param string $period
     */
    public function __construct(string $period)
    {
        $this->period = $period;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPeriod(): string
    {
        return $this->period;
    }

    public function getInitial(): ?bool
    {
        return $this->initial;
    }

    public function isInitial(): bool
    {
        return $this->initial === true;
    }

    public function isNotInitial(): bool
    {
        return $this->initial === false;
    }

    public function getNextPoint(): ?DateTimeImmutable
    {
        return $this->next_point;
    }

    public function getRetriesExceeded(): ?bool
    {
        return $this->retries_exceeded;
    }
}
