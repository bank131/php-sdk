<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\Recurrent;

use DateTimeImmutable;

/**
 * Class RecurrentDetails
 *
 * @psalm-suppress MissingConstructor
 */
class RecurrentDetails
{
    /**
     * @var string
     */
    private $token;

    /**
     * @var DateTimeImmutable
     */
    private $created_at;

    /**
     * @var DateTimeImmutable
     */
    private $finished_at;

    /**
     * @var bool
     */
    private $is_active;

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->created_at;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getFinishedAt(): DateTimeImmutable
    {
        return $this->finished_at;
    }

    /**
     * @return bool
     */
    public function getIsActive(): bool
    {
        return $this->is_active;
    }
}
