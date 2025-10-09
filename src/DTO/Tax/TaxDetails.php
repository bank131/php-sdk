<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\Tax;

class TaxDetails
{
    /**
     * @var string
     */
    private $kbk;

    /**
     * @var string
     */
    private $oktmo;

    /**
     * @var string
     */
    private $payment_reason;

    /**
     * @var string
     */
    private $period;

    /**
     * @var string
     */
    private $document_number;

    /**
     * @var string
     */
    private $document_date;

    public function __construct(
        string $kbk,
        string $oktmo,
        string $payment_reason,
        string $period,
        string $document_number,
        string $document_date
    ) {
        $this->kbk = $kbk;
        $this->oktmo = $oktmo;
        $this->payment_reason = $payment_reason;
        $this->period = $period;
        $this->document_number = $document_number;
        $this->document_date = $document_date;
    }

    public function getKbk(): string
    {
        return $this->kbk;
    }

    public function getOktmo(): string
    {
        return $this->oktmo;
    }

    public function getPaymentReason(): string
    {
        return $this->payment_reason;
    }

    public function getPeriod(): string
    {
        return $this->period;
    }

    public function getDocumentNumber(): string
    {
        return $this->document_number;
    }

    public function getDocumentDate(): string
    {
        return $this->document_date;
    }
}
