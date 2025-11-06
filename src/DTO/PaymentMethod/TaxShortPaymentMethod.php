<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\PaymentMethod;

use Bank131\SDK\DTO\PaymentMethod\Enum\PaymentMethodEnum;
use Bank131\SDK\DTO\Tax\TaxPaymentMethodEnum;
use Bank131\SDK\DTO\Tax\TaxShortDetails;

class TaxShortPaymentMethod extends PaymentMethod
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var TaxShortDetails
     */
    private $tax_details;

    public function __construct(
        TaxShortDetails $taxDetails
    ) {
        $this->type = TaxPaymentMethodEnum::TAX_SHORT;
        $this->tax_details = $taxDetails;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getPaymentMethodType(): string
    {
        return PaymentMethodEnum::TAX;
    }

    public function getTaxDetails(): TaxShortDetails
    {
        return $this->tax_details;
    }
}
