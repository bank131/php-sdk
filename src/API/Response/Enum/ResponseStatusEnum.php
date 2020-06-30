<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Response\Enum;

use Bank131\SDK\Helper\BaseEnum;

class ResponseStatusEnum extends BaseEnum
{
    /**
     * Success status
     */
    public const OK = "ok";

    /**
     * Error status
     */
    public const ERROR = "error";
}