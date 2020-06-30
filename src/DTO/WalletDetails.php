<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO;

class WalletDetails
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var Amount
     */
    private $amount_details;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return Amount
     */
    public function getAmountDetails(): Amount
    {
        return $this->amount_details;
    }
}