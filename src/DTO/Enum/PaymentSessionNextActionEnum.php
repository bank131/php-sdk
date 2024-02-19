<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\Enum;

use Bank131\SDK\Helper\BaseEnum;

class PaymentSessionNextActionEnum extends BaseEnum
{
    public const CONFIRM = 'confirm';

    public const CAPTURE = 'capture';
}