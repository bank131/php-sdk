<?php
declare(strict_types=1);

namespace Bank131\SDK\DTO;

use DateTimeImmutable;

class IdentityDocument
{
    /**
     * @var string
     */
    private $id_type;

    /**
     * @var string
     */
    private $id_number;

    /**
     * @var DateTimeImmutable
     */
    private $id_expiration_date;

    /**
     * @var DateTimeImmutable|null
     */
    private $issue_date;

    /**
     * @var string|null
     */
    private $division_code;

    public function getIssueDate(): ?DateTimeImmutable
    {
        return $this->issue_date;
    }

    public function setIssueDate(?DateTimeImmutable $issue_date): void
    {
        $this->issue_date = $issue_date;
    }

    public function getDivisionCode(): ?string
    {
        return $this->division_code;
    }

    public function setDivisionCode(?string $division_code): void
    {
        $this->division_code = $division_code;
    }

    public function getIssuedBy(): ?string
    {
        return $this->issued_by;
    }

    public function setIssuedBy(?string $issued_by): void
    {
        $this->issued_by = $issued_by;
    }

    /**
     * @var string|null
     */
    private $issued_by;

    public function __construct(
        string             $id_type,
        string             $id_number,
        DateTimeImmutable  $id_expiration_date,
        ?DateTimeImmutable $issue_date = null,
        ?string            $division_code = null,
        ?string            $issued_by = null
    ) {
        $this->id_type            = $id_type;
        $this->id_number          = $id_number;
        $this->id_expiration_date = $id_expiration_date;
        $this->issue_date         = $issue_date;
        $this->division_code      = $division_code;
        $this->issued_by          = $issued_by;
    }

    public function getIdType(): string
    {
        return $this->id_type;
    }

    public function setIdType(string $id_type): void
    {
        $this->id_type = $id_type;
    }

    public function getIdNumber(): string
    {
        return $this->id_number;
    }

    public function setIdNumber(string $id_number): void
    {
        $this->id_number = $id_number;
    }

    public function getIdExpirationDate(): DateTimeImmutable
    {
        return $this->id_expiration_date;
    }

    public function setIdExpirationDate(DateTimeImmutable $id_expiration_date): void
    {
        $this->id_expiration_date = $id_expiration_date;
    }
}
