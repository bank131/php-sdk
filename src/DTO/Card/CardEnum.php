<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\Card;

use Bank131\SDK\Helper\BaseEnum;

class CardEnum extends BaseEnum
{
    public const BANK_CARD = 'bank_card';

    public const ENCRYPTED_CARD = 'encrypted_card';
}