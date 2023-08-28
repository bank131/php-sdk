<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO;

use Bank131\SDK\Exception\InvalidArgumentException;

class Participant
{
    /**
     * @var string|null
     */
    protected $full_name;

    /**
     * @var string|null
     */
    protected $first_name;

    /**
     * @var string|null
     */
    protected $last_name;

    /**
     * @var string|null
     */
    protected $middle_name;

    /**
     * @var string|null
     */
    protected $company_name;

    /**
     * @var string|null
     */
    protected $reference;

    /**
     * @var string|null
     */
    protected $tax_reference;

    /**
     * @var string|null
     */
    protected $country_iso2;

    /**
     * @var string|null
     */
    protected $country_iso3;

    /**
     * @var string|null
     */
    protected $city;

    /**
     * @var string|null
     */
    protected $postal_code;

    /**
     * @var string|null
     */
    protected $address_line;

    /**
     * @var string|null
     */
    protected $building;

    /**
     * @var string|null
     */
    protected $ipv4;

    /**
     * @var string|null
     */
    protected $ipv6;

    /**
     * @var string|null
     */
    protected $state;

    /**
     * @var string|null
     */
    protected $document;

    /**
     * @var string|null
     */
    protected $account;

    /**
     * @var string|null
     */
    protected $currency;

    /**
     * @var string|null
     */
    protected $bank_name;

    /**
     * @var string|null
     */
    protected $registration_number;

    /**
     * @var string|null
     */
    protected $date_of_incorporation;

    /**
     * @var string|null
     */
    protected $msisdn;

    /**
     * @var string|null
     */
    protected $email;

    /**
     * @var string|null
     */
    protected $code;

    /**
     * @var string|null
     */
    protected $swift_bic_code;

    /**
     * @var string|null
     */
    protected $description;

    /**
     * @var IdentityDocument|null
     */
    protected $identity_document;

    /**
     * @var array|null
     */
    protected $provider_metadata;

    /**
     * @return string|null
     */
    public function getFullName(): ?string
    {
        return $this->full_name;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    /**
     * @return string|null
     */
    public function getMiddleName(): ?string
    {
        return $this->middle_name;
    }

    /**
     * @return string|null
     */
    public function getCompanyName(): ?string
    {
        return $this->company_name;
    }

    /**
     * @return string|null
     */
    public function getReference(): ?string
    {
        return $this->reference;
    }

    /**
     * @return string|null
     */
    public function getTaxReference(): ?string
    {
        return $this->tax_reference;
    }

    /**
     * @return string|null
     */
    public function getCountryIso2(): ?string
    {
        return $this->country_iso2;
    }

    /**
     * @return string|null
     */
    public function getCountryIso3(): ?string
    {
        return $this->country_iso3;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @return string|null
     */
    public function getPostalCode(): ?string
    {
        return $this->postal_code;
    }

    /**
     * @return string|null
     */
    public function getAddressLine(): ?string
    {
        return $this->address_line;
    }

    /**
     * @return string|null
     */
    public function getIpv4(): ?string
    {
        return $this->ipv4;
    }

    /**
     * @return string|null
     */
    public function getIpv6(): ?string
    {
        return $this->ipv6;
    }

    /**
     * @param string $full_name
     */
    public function setFullName(string $full_name): void
    {
        $this->full_name = $full_name;
    }

    /**
     * @param string $first_name
     */
    public function setFirstName(string $first_name): void
    {
        $this->first_name = $first_name;
    }

    /**
     * @param string $last_name
     */
    public function setLastName(string $last_name): void
    {
        $this->last_name = $last_name;
    }

    /**
     * @param string $middle_name
     */
    public function setMiddleName(string $middle_name): void
    {
        $this->middle_name = $middle_name;
    }

    /**
     * @param string $company_name
     */
    public function setCompanyName(string $company_name): void
    {
        $this->company_name = $company_name;
    }

    /**
     * @param string $reference
     */
    public function setReference(string $reference): void
    {
        $this->reference = $reference;
    }

    /**
     * @param string $tax_reference
     */
    public function setTaxReference(string $tax_reference): void
    {
        $this->tax_reference = $tax_reference;
    }

    /**
     * @param string $country_iso2
     */
    public function setCountryIso2(string $country_iso2): void
    {
        $this->country_iso2 = $country_iso2;
    }

    /**
     * @param string $country_iso3
     */
    public function setCountryIso3(string $country_iso3): void
    {
        $this->country_iso3 = $country_iso3;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * @param string $postal_code
     */
    public function setPostalCode(string $postal_code): void
    {
        $this->postal_code = $postal_code;
    }

    /**
     * @param string $address_line
     */
    public function setAddressLine(string $address_line): void
    {
        $this->address_line = $address_line;
    }

    /**
     * @param string $ipv4
     */
    public function setIpv4(string $ipv4): void
    {
        if (filter_var($ipv4, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) === false) {
            throw new InvalidArgumentException('This IP must be v4');
        }

        $this->ipv4 = $ipv4;
    }

    /**
     * @param string $ipv6
     */
    public function setIpv6(string $ipv6): void
    {
        if (filter_var($ipv6, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) === false) {
            throw new InvalidArgumentException('This IP must be v6');
        }

        $this->ipv6 = $ipv6;
    }

    public function hasFullName(): bool
    {
        return $this->full_name !== null
            || ($this->first_name !== null && $this->last_name !== null);
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state): void
    {
        $this->state = $state;
    }

    public function getDocument(): ?string
    {
        return $this->document;
    }

    public function setDocument(?string $document): void
    {
        $this->document = $document;
    }

    public function getAccount(): ?string
    {
        return $this->account;
    }

    public function setAccount(?string $account): void
    {
        $this->account = $account;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(?string $currency): void
    {
        $this->currency = $currency;
    }

    public function getBankName(): ?string
    {
        return $this->bank_name;
    }

    public function setBankName(?string $bank_name): void
    {
        $this->bank_name = $bank_name;
    }

    public function getRegistrationNumber(): ?string
    {
        return $this->registration_number;
    }

    public function setRegistrationNumber(?string $registration_number): void
    {
        $this->registration_number = $registration_number;
    }

    public function getDateOfIncorporation(): ?string
    {
        return $this->date_of_incorporation;
    }

    public function setDateOfIncorporation(?string $date_of_incorporation): void
    {
        $this->date_of_incorporation = $date_of_incorporation;
    }

    public function getIdentityDocument(): ?IdentityDocument
    {
        return $this->identity_document;
    }

    public function setIdentityDocument(?IdentityDocument $identity_document): void
    {
        $this->identity_document = $identity_document;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getSwiftBicCode(): ?string
    {
        return $this->swift_bic_code;
    }

    public function setSwiftBicCode(?string $swift_bic_code): void
    {
        $this->swift_bic_code = $swift_bic_code;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): void
    {
        $this->code = $code;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getMsisdn(): ?string
    {
        return $this->msisdn;
    }

    public function setMsisdn(?string $msisdn): void
    {
        $this->msisdn = $msisdn;
    }

    public function getBuilding(): ?string
    {
        return $this->building;
    }

    public function setBuilding(?string $building): void
    {
        $this->building = $building;
    }

    public function getProviderMetadata(): ?array
    {
        return $this->provider_metadata;
    }

    public function setProviderMetadata(?array $provider_metadata): void
    {
        $this->provider_metadata = $provider_metadata;
    }
}
