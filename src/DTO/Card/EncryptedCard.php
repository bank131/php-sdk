<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\Card;

class EncryptedCard extends AbstractCard
{
    /**
     * @var string
     */
    private $number_hash;

    /**
     * @var string|null
     */
    private $expiration_date_hash;

    /**
     * @var string|null
     */
    private $security_code_hash;

    /**
     * @var string|null
     */
    private $cardholder_name_hash;

    /**
     * EncryptedCard constructor.
     *
     * @param string      $number_hash
     * @param string|null $expiration_date_hash
     * @param string|null $security_code_hash
     * @param string|null $cardholder_name_hash
     */
    public function __construct(
        string $number_hash,
        ?string $expiration_date_hash = null,
        ?string $security_code_hash = null,
        ?string $cardholder_name_hash = null
    ) {
        $this->number_hash          = $number_hash;
        $this->expiration_date_hash = $expiration_date_hash;
        $this->security_code_hash   = $security_code_hash;
        $this->cardholder_name_hash = $cardholder_name_hash;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return CardEnum::ENCRYPTED_CARD;
    }
}
