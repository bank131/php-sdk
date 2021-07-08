<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\PaymentMethod\Enum;

class PaymentMethodEnum
{
    public const CARD = 'card';

    public const WALLET = 'wallet';

    public const BANK_ACCOUNT = 'bank_account';

    public const RECURRENT = 'recurrent';

    public const SECURED_CARD = 'secured_card';
}