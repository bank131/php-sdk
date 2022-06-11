<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\PaymentMethod;

use Bank131\SDK\DTO\Card\AbstractCard;
use Bank131\SDK\DTO\Card\BankCard;
use Bank131\SDK\DTO\Card\EncryptedCard;
use Bank131\SDK\DTO\Card\TokenizedCard;
use Bank131\SDK\DTO\PaymentMethod\Enum\PaymentMethodEnum;
use Bank131\SDK\Exception\InvalidArgumentException;

class CardPaymentMethod extends PaymentMethod
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var TokenizedCard|null
     */
    private $tokenized_card;

    /**
     * @var EncryptedCard|null
     */
    private $encrypted_card;

    /**
     * @var BankCard|null
     */
    private $bank_card;

    /**
     * @var string|null
     */
    private $brand;

    /**
     * @var string|null
     */
    private $last4;

    /**
     * @var string|null
     */
    private $country_iso3;

    /**
     * CardPaymentMethod constructor.
     *
     * @param AbstractCard $card
     */
    public function __construct(AbstractCard $card)
    {
        if (!property_exists($this, $card->getType())) {
            throw new InvalidArgumentException('Invalid card type');
        }

        $this->type          = $card->getType();
        $this->{$this->type} = $card;
    }

    /**
     * @return string|null
     */
    public function getBrand(): ?string
    {
        return $this->brand;
    }

    /**
     * @return string|null
     */
    public function getLast4(): ?string
    {
        return $this->last4;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return PaymentMethodEnum::CARD;
    }

    public function getCountryIso3(): ?string
    {
        return $this->country_iso3;
    }
}
