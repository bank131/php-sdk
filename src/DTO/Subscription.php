<?php
declare(strict_types=1);

namespace Bank131\SDK\DTO;

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
}