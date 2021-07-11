<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\SecuredCard;

use Bank131\SDK\Helper\BaseEnum;

class SecuredCardEnum extends BaseEnum
{
    public const GOOGLE_PAY = 'google_pay';

    public const APPLE_PAY = 'apple_pay';
}
