<?php
declare(strict_types=1);

namespace Bank131\SDK\API\Response\Token;

class TokenInfo
{
    /**
     * @var string|null
     */
    private $token;

    /**
     * @var string|null
     */
    private $number_hash;

    /**
     * @var string
     */
    private $brand;

    /**
     * @var string
     */
    private $last4;

    /**
     * @var string|null
     */
    private $country_iso3;

    /**
     * @var string
     */
    private $type;

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function getNumberHash(): ?string
    {
        return $this->number_hash;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function getLast4(): string
    {
        return $this->last4;
    }

    public function getCountryIso3(): ?string
    {
        return $this->country_iso3;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
