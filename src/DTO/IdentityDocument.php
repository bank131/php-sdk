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

    public function __construct(string $id_type, string $id_number, DateTimeImmutable $id_expiration_date)
    {
        $this->id_type            = $id_type;
        $this->id_number          = $id_number;
        $this->id_expiration_date = $id_expiration_date;
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
