<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\BankAccount;

use Bank131\SDK\Helper\BaseEnum;

class BankAccountEnum extends BaseEnum
{
    public const RU = 'ru';

    public const IBAN = 'iban';

    public const UPI = 'upi';

    public const FASTER_PAYMENT_SYSTEM = 'faster_payment_system';

    public const FASTER_PAYMENT_SYSTEM_VERIFICATION = 'faster_payment_system_verification';
}