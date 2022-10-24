<?php
declare(strict_types=1);

namespace Bank131\SDK\DTO\Enum;

use Bank131\SDK\Helper\BaseEnum;

class TokenInfoTypeEnum extends BaseEnum
{
    public const CARD = 'card';

    public const PUBLIC_TOKEN = 'public_token';

    public const RECURRENT_TOKEN = 'recurrent_token';
}
