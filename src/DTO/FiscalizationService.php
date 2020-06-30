<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO;

class FiscalizationService
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var Amount
     */
    private $amount_details;

    /**
     * @var int
     */
    private $quantity;

    /**
     * FiscalizationService constructor.
     *
     * @param string $name
     * @param Amount $amount_details
     * @param int    $quantity
     */
    public function __construct(string $name, Amount $amount_details, int $quantity)
    {
        $this->name           = $name;
        $this->amount_details = $amount_details;
        $this->quantity       = $quantity;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Amount
     */
    public function getAmountDetails(): Amount
    {
        return $this->amount_details;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }


}