<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO;

use Bank131\SDK\DTO\Collection\AcquiringPaymentCollection;
use Bank131\SDK\DTO\Collection\PaymentCollection;
use Bank131\SDK\DTO\Enum\SessionStatusEnum;
use DateTimeImmutable;

class Session
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $status;

    /**
     * @var DateTimeImmutable
     */
    private $created_at;

    /**
     * @var DateTimeImmutable
     */
    private $updated_at;

    /**
     * @var DateTimeImmutable|null
     */
    private $finished_at;

    /**
     * @var AcquiringPaymentCollection|null
     */
    private $acquiring_payments;

    /**
     * @var AcquiringPaymentCollection|null
     */
    private $payment_list;

    /**
     * @var PaymentCollection|null
     */
    private $payments;

    /**
     * @var PaymentCollection|null
     */
    private $payout_list;

    /**
     * @var string|null
     */
    private $next_action;

    /**
     * @var Error|null
     */
    private $error;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
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
    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updated_at;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getFinishedAt(): ?DateTimeImmutable
    {
        return $this->finished_at;
    }

    /**
     * @return AcquiringPaymentCollection
     */
    public function getAcquiringPayments(): AcquiringPaymentCollection
    {
        return $this->acquiring_payments ?? $this->payment_list ?? new AcquiringPaymentCollection();
    }

    /**
     * @return PaymentCollection
     */
    public function getPayments(): PaymentCollection
    {
        return $this->payments ?? $this->payout_list ?? new PaymentCollection();
    }

    /**
     * @return string|null
     */
    public function getNextAction(): ?string
    {
        return $this->next_action;
    }

    /**
     * @return Error
     */
    public function getError(): ?Error
    {
        return $this->error;
    }

    /**
     * @return bool
     */
    public function isCreated(): bool
    {
        return $this->status === SessionStatusEnum::CREATED;
    }

    /**
     * @return bool
     */
    public function isInProgress(): bool
    {
        return $this->status === SessionStatusEnum::IN_PROGRESS;
    }

    /**
     * @return bool
     */
    public function isAccepted(): bool
    {
        return $this->status === SessionStatusEnum::ACCEPTED;
    }

    /**
     * @return bool
     */
    public function isCancelled(): bool
    {
        return $this->status === SessionStatusEnum::CANCELLED;
    }

    /**
     * @return bool
     */
    public function isFailed(): bool
    {
        return $this->status === SessionStatusEnum::ERROR;
    }

    /**
     * @return bool
     */
    public function hasNextAction(): bool
    {
        return $this->next_action !== null;
    }
}