<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO;

use Bank131\SDK\DTO\Collection\CustomerContactCollection;

class Customer
{
    /**
     * @var string
     */
    private $reference;

    /**
     * @var CustomerContactCollection
     */
    private $contacts;

    /**
     * Customer constructor.
     *
     * @param string            $reference
     * @param CustomerContact[] $contacts
     */
    public function __construct(string $reference, array $contacts = [])
    {
        $this->reference = $reference;
        $this->contacts  = new CustomerContactCollection($contacts);
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @return CustomerContactCollection
     */
    public function getContacts(): CustomerContactCollection
    {
        return $this->contacts;
    }
}