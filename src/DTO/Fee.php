<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO;

class Fee
{
    /**
     * @var Amount|null
     */
    private $merchant_fee;

    public function getMerchantFee(): ?Amount
    {
        return $this->merchant_fee;
    }
}
