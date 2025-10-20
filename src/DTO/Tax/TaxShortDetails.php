<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\Tax;

class TaxShortDetails
{
    /**
     * @var TaxPeriod|null
     */
    private $period;

    public function __construct(?TaxPeriod $period = null)
    {
        $this->period = $period;
    }

    public function getPeriod(): ?TaxPeriod
    {
        return $this->period;
    }
}
