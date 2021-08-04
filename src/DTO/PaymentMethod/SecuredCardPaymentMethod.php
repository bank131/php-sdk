<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\PaymentMethod;

use Bank131\SDK\DTO\PaymentMethod\Enum\PaymentMethodEnum;
use Bank131\SDK\DTO\SecuredCard\AbstractSecuredCard;
use Bank131\SDK\DTO\SecuredCard\ApplePaySecuredCard;
use Bank131\SDK\DTO\SecuredCard\GooglePaySecuredCard;
use Bank131\SDK\Exception\InvalidArgumentException;

class SecuredCardPaymentMethod extends PaymentMethod
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var GooglePaySecuredCard|null
     */
    private $google_pay;

    /**
     * @var ApplePaySecuredCard|null
     */
    private $apple_pay;

    /**
     * SecuredCardPaymentMethod constructor.
     *
     * @param AbstractSecuredCard $card
     */
    public function __construct(AbstractSecuredCard $card)
    {
        if (!property_exists($this, $card->getType())) {
            throw new InvalidArgumentException('Invalid secured card type');
        }

        $this->type          = $card->getType();
        $this->{$this->type} = $card;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return PaymentMethodEnum::SECURED_CARD;
    }

    public function getGooglePay(): ?GooglePaySecuredCard
    {
        return $this->google_pay;
    }

    public function getApplePay(): ?ApplePaySecuredCard
    {
        return $this->apple_pay;
    }
}
