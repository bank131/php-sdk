<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\PlatformDetails\Enum;

use Bank131\SDK\Helper\BaseEnum;

final class OsEnum extends BaseEnum
{
    public const IOS = 'ios';

    public const ANDROID = 'android';

    public const WINDOWS = 'windows';

    public const LINUX = 'linux';
}
