<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\PaymentMethod;

use Bank131\SDK\DTO\PaymentMethod\Enum\PaymentMethodEnum;
use Bank131\SDK\DTO\Tax\TaxDetails;
use Bank131\SDK\DTO\Tax\TaxPayee;
use Bank131\SDK\DTO\Tax\TaxPayer;
use Bank131\SDK\DTO\Tax\TaxPaymentMethodEnum;

class TaxFullPaymentMethod extends PaymentMethod
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $uin;

    /**
     * @var TaxDetails
     */
    private $tax_details;

    /**
     * @var TaxPayer
     */
    private $payer;

    /**
     * @var TaxPayee
     */
    private $payee;

    public function __construct(
        string $description,
        string $uin,
        TaxDetails $taxDetails,
        TaxPayer $payer,
        TaxPayee $payee
    ) {
        $this->type = TaxPaymentMethodEnum::TAX_FULL;
        $this->description = $description;
        $this->uin = $uin;
        $this->tax_details = $taxDetails;
        $this->payer = $payer;
        $this->payee = $payee;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getPaymentMethodType(): string
    {
        return PaymentMethodEnum::TAX;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getUin(): string
    {
        return $this->uin;
    }

    public function getTaxDetails(): TaxDetails
    {
        return $this->tax_details;
    }

    public function getPayer(): TaxPayer
    {
        return $this->payer;
    }

    public function getPayee(): TaxPayee
    {
        return $this->payee;
    }
}
