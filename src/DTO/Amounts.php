<?php
declare(strict_types=1);

namespace Bank131\SDK\DTO;

use Bank131\SDK\DTO\Collection\AmountCollection;

class Amounts
{
    /**
     * @var Amount|null
     */
    private $net;

    /**
     * @var Amount|null
     */
    private $gross;

    /**
     * @var Fee|null
     */
    private $fee;

    public function getNet(): ?Amount
    {
        return $this->net;
    }

    public function getGross(): ?Amount
    {
        return $this->gross;
    }

    /**
     * @return Fee|null
     */
    public function getFee(): ?Fee
    {
        return $this->fee;
    }
}
