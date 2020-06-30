<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO;

use Bank131\SDK\DTO\Collection\FiscalizationServiceCollection;
use Bank131\SDK\DTO\Enum\NpdIncomeTypeEnum;
use Bank131\SDK\Exception\InvalidArgumentException;

class ProfessionalIncomeTaxpayer
{
    /**
     * @var FiscalizationServiceCollection
     */
    private $services;

    /**
     * @var string
     */
    private $tax_reference;

    /**
     * @var FiscalizationReceipt|null
     */
    private $receipt;

    /**
     * @var string|null
     */
    private $payer_type;

    /**
     * @var string|null
     */
    private $payer_tax_number;

    /**
     * @var string|null
     */
    private $payer_name;

    /**
     * ProfessionalIncomeTaxpayer constructor.
     *
     * @param FiscalizationServiceCollection $services
     * @param string                         $taxReference
     */
    public function __construct(FiscalizationServiceCollection $services, string $taxReference)
    {
        if (!preg_match('/^\d{12}$/', $taxReference)) {
            throw new InvalidArgumentException('Tax reference value must be a number 12 digits long');
        }

        $this->services      = $services;
        $this->tax_reference = $taxReference;
    }

    /**
     * @param string $payerType
     */
    public function setPayerType(string $payerType): void
    {
        if (!in_array($payerType, NpdIncomeTypeEnum::all(), true)) {
            throw new InvalidArgumentException(
                'Payer type value must be one of: ' . implode(', ', NpdIncomeTypeEnum::all())
            );
        }

        $this->payer_type = $payerType;
    }

    /**
     * @param string $payerTaxNumber
     */
    public function setPayerTaxNumber(string $payerTaxNumber): void
    {
        $this->payer_tax_number = $payerTaxNumber;
    }

    /**
     * @param string $payerName
     */
    public function setPayerName(string $payerName): void
    {
        $this->payer_name = $payerName;
    }

    /**
     * @return FiscalizationServiceCollection
     */
    public function getServices(): FiscalizationServiceCollection
    {
        return $this->services;
    }

    /**
     * @return string
     */
    public function getTaxReference(): string
    {
        return $this->tax_reference;
    }

    /**
     * @return FiscalizationReceipt|null
     */
    public function getReceipt(): ?FiscalizationReceipt
    {
        return $this->receipt;
    }

    /**
     * @return string|null
     */
    public function getPayerType(): ?string
    {
        return $this->payer_type;
    }

    /**
     * @return string|null
     */
    public function getPayerTaxNumber(): ?string
    {
        return $this->payer_tax_number;
    }

    /**
     * @return string|null
     */
    public function getPayerName(): ?string
    {
        return $this->payer_name;
    }
}