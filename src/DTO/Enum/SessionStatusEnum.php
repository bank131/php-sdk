<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\Enum;

class SessionStatusEnum
{
    /**
     * This status means that session is created and is waiting to be started or canceled.
     */
    public const CREATED = 'created';

    /**
     * This status means that session is being processed.
     */
    public const IN_PROGRESS = 'in_progress';

    /**
     * This status means that session is finished successfully.
     */
    public const ACCEPTED = 'accepted';

    /**
     * This status means that session is canceled.
     */
    public const CANCELLED = 'cancelled';

    /**
     * This status means that session is finished unsuccessfully. An error happened during session processing.
     */
    public const ERROR = 'error';
}