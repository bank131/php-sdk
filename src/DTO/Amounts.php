<?php
declare(strict_types=1);

namespace Bank131\SDK\DTO;

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

    public function getNet(): ?Amount
    {
        return $this->net;
    }

    public function getGross(): ?Amount
    {
        return $this->gross;
    }
}
