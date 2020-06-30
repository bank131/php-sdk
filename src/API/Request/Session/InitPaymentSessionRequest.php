<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Request\Session;

use Bank131\SDK\DTO\Amount;
use Bank131\SDK\DTO\Card\AbstractCard;
use Bank131\SDK\DTO\Customer;
use Bank131\SDK\DTO\PaymentDetails;

class InitPaymentSessionRequest extends AbstractSessionRequest
{
    /**
     * InitSessionRequest constructor.
     *
     * @param PaymentDetails $card
     * @param Amount         $amount
     * @param Customer       $customer
     */
    public function __construct(PaymentDetails $card, Amount $amount, Customer $customer)
    {
        $this->setPaymentDetails($card);
        $this->setAmount($amount);
        $this->setCustomer($customer);
    }
}