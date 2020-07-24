<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Response\Recurrent;

use Bank131\SDK\API\Response\AbstractResponse;
use DateTimeImmutable;

/**
 * Class RecurrentStatusResponse
 *
 * @psalm-suppress MissingConstructor
 */
class RecurrentStatusResponse extends AbstractResponse
{
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
     * Get createdAt property
     *
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->created_at;
    }

    /**
     * Get finishedAt property
     *
     * @return DateTimeImmutable
     */
    public function getFinishedAt(): DateTimeImmutable
    {
        return $this->finished_at;
    }

    /**
     * Get isActive property
     *
     * @return bool
     */
    public function getIsActive(): bool
    {
        return $this->is_active;
    }
}
