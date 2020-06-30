<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO;

class FiscalizationDetails
{
    /**
     * @var ProfessionalIncomeTaxpayer
     */
    private $professional_income_taxpayer;

    /**
     * FiscalizationDetails constructor.
     *
     * @param ProfessionalIncomeTaxpayer $professionalIncomeTaxpayer
     */
    public function __construct(ProfessionalIncomeTaxpayer $professionalIncomeTaxpayer)
    {
        $this->professional_income_taxpayer = $professionalIncomeTaxpayer;
    }

    /**
     * @return ProfessionalIncomeTaxpayer
     */
    public function getProfessionalIncomeTaxpayer(): ProfessionalIncomeTaxpayer
    {
        return $this->professional_income_taxpayer;
    }
}