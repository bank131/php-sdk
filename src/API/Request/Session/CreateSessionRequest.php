<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Request\Session;

use Bank131\SDK\DTO\PaymentMethod\BankAccountPaymentMethod;

class CreateSessionRequest extends AbstractSessionRequest
{
    public function getBankAccountPaymentMethod(): ?BankAccountPaymentMethod
    {
        return parent::getBankAccountPaymentMethod();
    }
}