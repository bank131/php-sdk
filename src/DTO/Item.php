<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO;

class Item
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var Amount
     */
    private $amount_details;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @var string
     */
    private $category_code;

    private function __construct(
        string $id,
        string $name,
        string $description,
        int $amount,
        string $currency,
        int $quantity,
        string $category_code
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->amount_details = new Amount($amount, $currency);
        $this->quantity = $quantity;
        $this->category_code = $category_code;
    }

    public static function create(
        string $id,
        string $name,
        string $description,
        int $amount,
        string $currency,
        int $quantity,
        string $category_code
    ): self {
        return new self(
            $id,
            $name,
            $description,
            $amount,
            $currency,
            $quantity,
            $category_code
        );
    }
}