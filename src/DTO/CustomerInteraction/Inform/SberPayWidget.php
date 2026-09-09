<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\CustomerInteraction\Inform;

class SberPayWidget
{
    /**
     * @var string
     */
    private $order_id;

    public function getOrderId(): string
    {
        return $this->order_id;
    }
}
