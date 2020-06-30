<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\Enum;

use Bank131\SDK\Helper\BaseEnum;

class NpdIncomeTypeEnum extends BaseEnum
{
    public const LEGAL      = 'legal';

    public const INDIVIDUAL = 'individual';

    public const FOREIGN    = 'foreign';
}